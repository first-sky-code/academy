<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PelatihanController extends Controller
{
    public function pelatihan()
    {
        $user = Auth::user();

        $query = DB::table('pelatihan')
            ->join('kategori_pelatihan', 'pelatihan.kategori_pelatihan_id', '=', 'kategori_pelatihan.kategori_pelatihan_id')
            ->leftJoin('pelatihan_syarat', 'pelatihan.pelatihan_id', '=', 'pelatihan_syarat.pelatihan_id')
            ->leftJoin('syarat', 'pelatihan_syarat.syarat_id', '=', 'syarat.syarat_id')
            ->leftJoin('users', 'pelatihan.users_id', '=', 'users.id')
            ->select(
                'pelatihan.pelatihan_id',
                'pelatihan.pelatihan_name',
                'pelatihan.pelatihan_silabus',
                'pelatihan.pelatihan_tatacara',
                'pelatihan.pelatihan_mulai',
                'pelatihan.pelatihan_tutup',
                'pelatihan.pelatihan_jadwal',
                'pelatihan.users_id',
                'kategori_pelatihan.kategori_pelatihan_name',
                'users.name as nama_pembuat',
                DB::raw('GROUP_CONCAT(DISTINCT syarat.syarat_name SEPARATOR ", ") as daftar_syarat')
            );

        if ($user->usertype !== 'admin') {
            $query->where('pelatihan.users_id', $user->id);
        }

        $data['tabel'] = $query->groupBy(
            'pelatihan.pelatihan_id',
            'pelatihan.pelatihan_name',
            'pelatihan.pelatihan_silabus',
            'pelatihan.pelatihan_tatacara',
            'pelatihan.pelatihan_mulai',
            'pelatihan.pelatihan_tutup',
            'pelatihan.pelatihan_jadwal',
            'pelatihan.users_id',
            'kategori_pelatihan.kategori_pelatihan_name',
            'users.name'
        )
            ->get();

        return view('pelatihan.pelatihan', ['data' => $data]);
    }

    public function input(Request $request)
    {
        $id = $request->id;
        $ketemu = DB::table('pelatihan')->where('pelatihan_id', $id)->first();

        $data = [
            'id'               => $id,
            'ketemu'           => $ketemu,
            'kategori'         => DB::table('kategori_pelatihan')->get(),
            'syarat'           => DB::table('syarat')->get(),
            'syarat_terpilih'  => DB::table('pelatihan_syarat')->where('pelatihan_id', $id)->pluck('syarat_id')->toArray(),
        ];

        return view('pelatihan.input', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $id = $request->id;
        $user = Auth::user();
        $pelatihanLama = DB::table('pelatihan')->where('pelatihan_id', $id)->first();

        // Validasi dasar
        $request->validate([
            'pelatihan_name' => 'required',
            'kategori_pelatihan_id' => 'required',
            'silabus' => 'nullable|mimes:pdf,doc,docx|max:2048'
            // 'pelatihan_syarat' => 'nullable',
        ]);

        $dataPelatihan = [
            'pelatihan_name'        => $request->pelatihan_name,
            'kategori_pelatihan_id' => $request->kategori_pelatihan_id,
            'pelatihan_jadwal'      => $request->pelatihan_jadwal,
            'pelatihan_mulai'       => $request->pelatihan_mulai,
            'pelatihan_tutup'       => $request->pelatihan_tutup,
            'pelatihan_tatacara'    => $request->pelatihan_tatacara,
            'users_id'              => ($id != 0 && $pelatihanLama) ? $pelatihanLama->users_id : $user->id,
        ];

        // Logika Upload Silabus
        if ($request->hasFile('silabus')) {
            // Hapus file lama jika sedang mode edit
            if ($id != 0) {
                $oldFile = DB::table('pelatihan')->where('pelatihan_id', $id)->value('pelatihan_silabus');
                if ($oldFile) {
                    Storage::disk('public')->delete('silabus/' . $oldFile);
                }
            }

            $file = $request->file('silabus');
            $fileName = time() . '_Silabus_' . str_replace(' ', '_', $request->pelatihan_name) . '.' . $file->extension();
            $file->storeAs('silabus', $fileName, 'public');
            $dataPelatihan['pelatihan_silabus'] = $fileName;
        }

        if ($id != 0) {
            // Mode UPDATE
            DB::table('pelatihan')->where('pelatihan_id', $id)->update($dataPelatihan);
            $pelatihanId = $id;
            // Hapus relasi syarat lama (Sync)
            DB::table('pelatihan_syarat')->where('pelatihan_id', $pelatihanId)->delete();
        } else {
            // Mode INSERT
            $pelatihanId = DB::table('pelatihan')->insertGetId($dataPelatihan);
        }

        // Simpan Syarat Baru
        if ($request->has('syarat_id')) {
            foreach ($request->syarat_id as $s_id) {
                if (!empty($s_id)) {
                    DB::table('pelatihan_syarat')->insert([
                        'pelatihan_id' => $pelatihanId,
                        'syarat_id'    => $s_id
                    ]);
                }
            }
        }

        return redirect()->route('pelatihan.pelatihan')->with('success', 'Data berhasil disimpan');
    }

    public function hapus(Request $request)
    {
        $id = $request->id;
        $ketemu = DB::table('pelatihan')->where('pelatihan_id', $id)->first();

        return view('pelatihan.hapus', [
            'id' => $id,
            'ketemu' => $ketemu
        ]);
    }

    public function delete(Request $request)
    {
        $id = $request->id;

        $oldFile = DB::table('pelatihan')->where('pelatihan_id', $id)->value('pelatihan_silabus');
        if ($oldFile) {
            Storage::disk('public')->delete('silabus/' . $oldFile);
        }

        DB::table('pelatihan_syarat')->where('pelatihan_id', $id)->delete();

        DB::table('pelatihan')->where('pelatihan_id', $id)->delete();

        return redirect()->route('pelatihan.pelatihan')->with('success', 'Data berhasil dihapus permanen dari sistem');
    }
}
