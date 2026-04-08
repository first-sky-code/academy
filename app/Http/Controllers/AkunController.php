<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AkunController extends Controller
{
    public function akun()
    {
        $data = [
            'isi' => DB::table('peserta')
                ->leftJoin('sekolah', 'peserta.sekolah_id', '=', 'sekolah.sekolah_id')
                ->leftJoin('opd', 'peserta.opd_id', '=', 'opd.opd_id')
                ->where('peserta_id', Auth::user()->peserta_id)
                ->select('peserta.*', 'sekolah.sekolah_name', 'opd.opd_name')
                ->get(),
        ];
        return view('akun.akun', ['data' => $data]);
    }

    public function edit(Request $request)
    {
        // 1. Ambil data sekolah dan opd untuk dropdown di view
        $sekolah = DB::table('sekolah')->get();
        $opd = DB::table('opd')->get();

        $data = [
            'peserta_id' => Auth::user()->peserta_id,
            'ketemu' => DB::table('peserta')->where('peserta_id', Auth::user()->peserta_id)->first(),
        ];

        // 2. Kirim variabel sekolah dan opd ke view
        return view('akun.edit', compact('data', 'sekolah', 'opd'));
    }

    public function store(Request $request)
    {
        // Validasi field lama dan field baru
        $request->validate([
            'peserta_nama_lengkap' => 'required|string|max:255',
            'peserta_asal_instansi' => 'required|string|max:255',
            'peserta_alamat' => 'required',
            'peserta_no_hp' => 'required|numeric|digits_between:10,15', // Digits disesuaikan
            'peserta_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:500',
            'peserta_unique_code' => 'nullable|string|min:10|max:18', // Validasi baru
            'peserta_tanggal_lahir' => 'nullable|date',      // Validasi baru
            'sekolah_id' => 'nullable|integer',              // Validasi baru
            'opd_id' => 'nullable|integer',                  // Validasi baru
        ]);

        $peserta = DB::table('peserta')->where('peserta_id', Auth::user()->peserta_id)->first();
        $simpan = $peserta->peserta_foto;

        if ($request->hasFile('peserta_foto')) {
            $image = $request->file('peserta_foto');
            // Gunakan ID unik atau timestamp agar nama file tidak bentrok
            $imageName = Auth::user()->peserta_name . '.' . $image->extension();
            $simpan = $image->storeAs('foto_peserta', $imageName, 'public');

            if ($peserta->peserta_foto) {
                Storage::disk('public')->delete($peserta->peserta_foto);
            }
        }

        // Update semua field termasuk data instansi dan kode unik
        DB::table('peserta')->where('peserta_id', Auth::user()->peserta_id)->update([
            'peserta_nama_lengkap' => $request->peserta_nama_lengkap,
            'peserta_asal_instansi' => $request->peserta_asal_instansi,
            'peserta_alamat' => $request->peserta_alamat,
            'peserta_no_hp' => $request->peserta_no_hp,
            'peserta_foto' => $simpan,
            'peserta_unique_code' => $request->peserta_unique_code,
            'peserta_tanggal_lahir' => $request->peserta_tanggal_lahir,
            'sekolah_id' => $request->sekolah_id,
            'opd_id' => $request->opd_id,
            'updated_at' => now(),
        ]);

        return redirect()->route('akun.akun')->with('success', 'Profil berhasil diperbarui');
    }
}
