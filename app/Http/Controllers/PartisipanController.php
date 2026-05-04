<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PartisipanController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $query = DB::table('pelatihan')
            ->leftJoin('users', 'pelatihan.users_id', '=', 'users.id') // Join ke tabel users
            ->select(
                'pelatihan.pelatihan_id',
                'pelatihan.pelatihan_name',
                'pelatihan.users_id',
                'users.name as nama_pemilik' // Ambil nama user
            );

        // Filter: Jika bukan admin, hanya lihat miliknya sendiri
        if ($user->usertype !== 'admin') {
            $query->where('pelatihan.users_id', $user->id);
        }

        $data_pelatihan = $query->get();

        return view('partisipan.index', compact('data_pelatihan'));
    }

    public function showPendaftar($id)
    {
        $user = Auth::user();

        $pelatihan = DB::table('pelatihan')->where('pelatihan_id', $id)->first();

        // DEBUG: Hapus ini setelah ketemu penyakitnya
        if (!$pelatihan) {
            dd("Pelatihan ID $id tidak ditemukan di database!");
        }

        if ($user->usertype !== 'admin' && $pelatihan->users_id !== $user->id) {
            dd("Akses Ditolak! Usertype Anda: " . $user->usertype . " | ID Anda: " . $user->id . " | Owner ID: " . $pelatihan->users_id);
        }

        if (!$pelatihan || (trim($user->usertype) != 'admin' && $pelatihan->users_id != $user->id)) {
            return redirect()->route('partisipan.index')->with('error', 'Anda tidak memiliki hak akses.');
        }
        $pendaftar = DB::table('pendaftaran')
            ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.peserta_id')
            ->join('status', 'pendaftaran.status_id', '=', 'status.status_id')
            ->where('pendaftaran.pelatihan_id', $id)
            ->select(
                'pendaftaran.*',
                'peserta.peserta_nama_lengkap',
                'peserta.peserta_alamat',
                'peserta.peserta_no_hp',
                'peserta.peserta_nisn', // Tambahkan ini
                'peserta.peserta_nip',  // Tambahkan ini
                'status.status_name'
            )
            ->get();

        $uploads = DB::table('upload')
            ->join('syarat', 'upload.syarat_id', '=', 'syarat.syarat_id')
            ->where('upload.pelatihan_id', $id)
            ->get()
            ->groupBy('pendaftaran_id');

        return view('partisipan.detail', compact('pendaftar', 'pelatihan', 'uploads'));
    }

    public function edit($id)
    {
        // Ambil data pendaftaran saja dulu
        $data = DB::table('pendaftaran')
            ->where('pendaftaran_id', $id)
            ->first();

        // Jika data tidak ketemu, balikkan agar tidak error
        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        // Ambil nama peserta secara terpisah agar query tidak berat
        $peserta = DB::table('peserta')->where('peserta_id', $data->peserta_id)->first();

        // Ambil opsi status
        $status = DB::table('status')->get();

        return view('partisipan.edit', compact('data', 'status', 'peserta'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status_id' => 'required',
            'pendaftaran_catatan' => 'nullable|string'
        ]);

        // Cari data pendaftaran dulu untuk mendapatkan pelatihan_id (untuk redirect kembali)
        $pendaftaran = DB::table('pendaftaran')->where('pendaftaran_id', $id)->first();

        DB::table('pendaftaran')->where('pendaftaran_id', $id)->update([
            'status_id' => $request->status_id,
            'pendaftaran_catatan' => $request->pendaftaran_catatan,
            'updated_at' => now()
        ]);

        // Redirect ke halaman detail pelatihan tadi, bukan stay di form edit
        return redirect()->route('partisipan.detail', $pendaftaran->pelatihan_id)
            ->with('success', 'Status pendaftaran berhasil diperbarui');
    }

    public function cetakAbsen($id)
    {
        $pelatihan = DB::table('pelatihan')->where('pelatihan_id', $id)->first();

        if (!$pelatihan) {
            return redirect()->back()->with('error', 'Data pelatihan tidak ditemukan.');
        }

        $pendaftar = DB::table('pendaftaran')
            ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.peserta_id')
            // Join ke tabel status untuk mendapatkan nama status
            ->join('status', 'pendaftaran.status_id', '=', 'status.status_id')
            ->leftJoin('sekolah', 'peserta.sekolah_id', '=', 'sekolah.sekolah_id')
            ->leftJoin('opd', 'peserta.opd_id', '=', 'opd.opd_id')
            ->where('pendaftaran.pelatihan_id', $id)
            // Filter berdasarkan kolom status_name di tabel status
            ->where('status.status_name', 'Pendaftaran Diterima')
            ->select(
                'peserta.peserta_nama_lengkap',
                'peserta.peserta_nisn',
                'peserta.peserta_nip',
                'peserta.peserta_alamat',
                'sekolah.sekolah_name',
                'opd.opd_name'
            )
            ->orderBy('peserta.peserta_nama_lengkap', 'asc')
            ->get();

        // if ($pendaftar->isEmpty()) {
        //     return redirect()->back()->with('info', 'Belum ada peserta dengan status Pendaftaran Diterima.');
        // }

        $html = view('partisipan.cetak_absen', compact('pendaftar', 'pelatihan'))->render();

        $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
        $mpdf->WriteHTML($html);

        return $mpdf->Output('Absensi_' . $pelatihan->pelatihan_name . '.pdf', 'I');
    }
}
