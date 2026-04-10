<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

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
        $sekolah = DB::table('sekolah')->get();
        $opd = DB::table('opd')->get();

        $data = [
            'peserta_id' => Auth::user()->peserta_id,
            'ketemu' => DB::table('peserta')->where('peserta_id', Auth::user()->peserta_id)->first(),
        ];

        return view('akun.edit', compact('data', 'sekolah', 'opd'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'peserta_nama_lengkap' => 'required|string|max:255',
            'peserta_tempat_lahir' => 'required|string|max:255',
            'peserta_alamat' => 'required',
            'peserta_no_hp' => 'required|numeric|digits_between:10,15',
            'peserta_foto' => 'nullable|image|mimes:jpeg,png,jpg|max:500',
            'peserta_nisn' => [
                'nullable',
                'string',
                'size:10',
                Rule::unique('peserta', 'peserta_nisn')->ignore(Auth::user()->peserta_id, 'peserta_id'),
            ],
            'peserta_nip' => [
                'nullable',
                'string',
                'size:18',
                Rule::unique('peserta', 'peserta_nip')->ignore(Auth::user()->peserta_id, 'peserta_id'),
            ],
            'peserta_tanggal_lahir' => 'nullable|date',
            'sekolah_id' => 'nullable|integer',
            'opd_id' => 'nullable|integer',
        ]);

        $peserta = DB::table('peserta')->where('peserta_id', Auth::user()->peserta_id)->first();
        $simpan = $peserta->peserta_foto;

        if ($request->hasFile('peserta_foto')) {
            $image = $request->file('peserta_foto');
            $imageName = Auth::user()->peserta_name . '.' . $image->extension();
            $simpan = $image->storeAs('foto_peserta', $imageName, 'public');

            if ($peserta->peserta_foto) {
                Storage::disk('public')->delete($peserta->peserta_foto);
            }
        }

        // Update semua field termasuk data instansi dan kode unik
        // Update semua field
        DB::table('peserta')->where('peserta_id', Auth::user()->peserta_id)->update([
            'peserta_nama_lengkap'  => $request->peserta_nama_lengkap,
            'peserta_tempat_lahir'  => $request->peserta_tempat_lahir,
            'peserta_alamat'        => $request->peserta_alamat,
            'peserta_no_hp'         => $request->peserta_no_hp,
            'peserta_foto'          => $simpan,
            'peserta_tanggal_lahir' => $request->peserta_tanggal_lahir,
            'sekolah_id'            => $request->sekolah_id,
            'opd_id'                => $request->opd_id,

            // Logika tambahan: Jika NISN diisi, NIP dikosongkan, dan sebaliknya
            'peserta_nisn'          => $request->peserta_nisn,
            'peserta_nip'           => $request->peserta_nip,

            'updated_at'            => now(),
        ]);

        return redirect()->route('akun.akun')->with('success', 'Profil berhasil diperbarui');
    }
}
