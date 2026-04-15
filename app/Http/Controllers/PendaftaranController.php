<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{
    public function index($id)
    {
        $pelatihan = DB::table('pelatihan')
            ->leftJoin('kategori_pelatihan', 'pelatihan.kategori_pelatihan_id', '=', 'kategori_pelatihan.kategori_pelatihan_id')
            ->leftJoin('pelatihan_mentor', 'pelatihan.pelatihan_id', '=', 'pelatihan_mentor.pelatihan_id')
            ->leftJoin('mentor', 'pelatihan_mentor.mentor_id', '=', 'mentor.mentor_id')
            ->where('pelatihan.pelatihan_id', $id)
            ->select(
                'pelatihan.pelatihan_id',
                'pelatihan.pelatihan_name',
                'pelatihan.pelatihan_tatacara',
                'pelatihan.pelatihan_mulai',
                'pelatihan.pelatihan_tutup',
                'pelatihan.pelatihan_jadwal',
                'kategori_pelatihan.kategori_pelatihan_name',
                DB::raw('GROUP_CONCAT(mentor.mentor_name SEPARATOR ", ") as daftar_mentor')
            )
            ->groupBy(
                'pelatihan.pelatihan_id',
                'pelatihan.pelatihan_name',
                'pelatihan.pelatihan_tatacara',
                'pelatihan.pelatihan_mulai',
                'pelatihan.pelatihan_tutup',
                'pelatihan.pelatihan_jadwal',
                'kategori_pelatihan.kategori_pelatihan_name'
            )
            ->first();

        if (!$pelatihan) {
            abort(404, 'Pelatihan tidak ditemukan');
        }

        $sudahDaftar = false;
        $tanggunganUploadId = null;

        if (Auth::check()) {
            $peserta_id = Auth::user()->peserta_id;

            $sudahDaftar = DB::table('pendaftaran')
                ->where('pelatihan_id', $id)
                ->where('peserta_id', $peserta_id)
                ->exists();

            $tanggungan = DB::table('pendaftaran')
                ->leftJoin('upload', 'pendaftaran.pendaftaran_id', '=', 'upload.pendaftaran_id')
                ->where('pendaftaran.peserta_id', $peserta_id)
                ->whereNull('upload.pendaftaran_id')
                ->select('pendaftaran.pendaftaran_id')
                ->first();

            if ($tanggungan) {
                $tanggunganUploadId = $tanggungan->pendaftaran_id;
            }
        }

        $data = [
            'id' => $id,
            'tabel1' => $pelatihan,
            'sudah_daftar' => $sudahDaftar,
            'tanggungan_id' => $tanggunganUploadId,
        ];

        return view('pendaftaran.index', compact('data'));
    }

    public function store($id)
    {
        $user = Auth::user();
        if (!$user) return redirect()->back()->with('error', 'Silahkan login terlebih dahulu.');

        // $tanggungan = DB::table('pendaftaran')
        //     ->leftJoin('upload', 'pendaftaran.pendaftaran_id', '=', 'upload.pendaftaran_id')
        //     ->where('pendaftaran.peserta_id', $user->peserta_id)
        //     ->whereNull('upload.pendaftaran_id')
        //     ->select('pendaftaran.pendaftaran_id', 'pendaftaran.pelatihan_id')
        //     ->first();

        // if ($tanggungan) {
        //     if ($tanggungan->pelatihan_id == $id) {
        //         return redirect()->route('pendaftaran.syarat', $tanggungan->pendaftaran_id);
        //     }
        //     return redirect()->route('pendaftaran.syarat', $tanggungan->pendaftaran_id)
        //         ->with('error', 'Selesaikan unggah berkas pendaftaran sebelumnya.');
        // }

        $cek = DB::table('pendaftaran')
            ->where('peserta_id', $user->peserta_id)
            ->where('pelatihan_id', $id)
            ->first();

        if ($cek) {
            return redirect()->route('pendaftaran.syarat', $cek->pendaftaran_id);
        }

        $pendaftaranId = DB::table('pendaftaran')->insertGetId([
            'peserta_id'   => $user->peserta_id,
            'pelatihan_id' => $id,
            'status_id'    => 4,
            'created_at'   => now(),
        ]);

        return redirect()->route('pendaftaran.syarat', $pendaftaranId);
    }

    public function inputSyarat($id)
    {
        $pendaftaran = DB::table('pendaftaran')
            ->join('pelatihan', 'pendaftaran.pelatihan_id', '=', 'pelatihan.pelatihan_id')
            ->where('pendaftaran_id', $id)
            ->first();

        if (!$pendaftaran) abort(404);

        $syaratList = DB::table('pelatihan_syarat')
            ->join('syarat', 'pelatihan_syarat.syarat_id', '=', 'syarat.syarat_id')
            ->where('pelatihan_syarat.pelatihan_id', $pendaftaran->pelatihan_id)
            ->get();

        return view('pendaftaran.input', compact('pendaftaran', 'syaratList'));
    }

    public function storeSyarat(Request $request, $id)
    {
        $request->validate(
            [
                'file_syarat' => 'required|array',
                'file_syarat.*' => 'file|mimes:jpg,jpeg,png,pdf|max:500',
            ],
            [
                'file_syarat.*.max' => 'Ukuran file :attribute maksimal adalah 500 KB.',
                'file_syarat.*.mimes' => 'Format file harus berupa JPG, PNG, atau PDF.',
                'file_syarat.*.file' => 'Input harus berupa file valid.',
            ]
        );

        $user = Auth::user();
        $pendaftaran = DB::table('pendaftaran')->where('pendaftaran_id', $id)->first();

        if (!$pendaftaran) {
            return redirect()->back()->with('error', 'Data pendaftaran tidak ditemukan.');
        }

        try {
            DB::transaction(function () use ($user, $request, $pendaftaran) {
                if ($request->hasFile('file_syarat')) {
                    foreach ($request->file('file_syarat') as $syaratId => $file) {
                        if ($file && $file->isValid()) {
                            $syarat = DB::table('syarat')->where('syarat_id', $syaratId)->first();
                            $syarat_name = $syarat ? str_replace(' ', '_', $syarat->syarat_name) : 'Syarat_' . $syaratId;

                            $namaCustom = $syarat_name . '_' . str_replace(' ', '_', $user->peserta_nama_lengkap) . '_' . time() . '.' . $file->extension();
                            $pathSimpan = $file->storeAs('folder_syarat', $namaCustom, 'public');

                            DB::table('upload')->updateOrInsert(
                                [
                                    'pendaftaran_id' => $pendaftaran->pendaftaran_id,
                                    'syarat_id'      => $syaratId
                                ],
                                [
                                    'peserta_id'     => $user->peserta_id,
                                    'pelatihan_id'   => $pendaftaran->pelatihan_id,
                                    'nama_file'      => $pathSimpan,
                                ]
                            );
                        }
                    }

                    DB::table('pendaftaran')
                        ->where('pendaftaran_id', $pendaftaran->pendaftaran_id)
                        ->update([
                            'status_id' => 1,
                            'updated_at' => now()
                        ]);
                }
            });

            return redirect()->route('riwayat.index')->with('success', 'Persyaratan berhasil diunggah!');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
