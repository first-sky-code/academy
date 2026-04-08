<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AsalController extends Controller
{
    // Fungsi pembantu internal untuk mengecek admin (opsional untuk meringkas kode)
    private function checkAdmin()
    {
        if (Auth::user()->usertype !== 'admin') {
            abort(403, 'Akses ditolak! Halaman ini hanya untuk Admin.');
        }
    }

    public function index()
    {
        $this->checkAdmin(); // Proteksi Admin

        $data = [
            'tabel1' => DB::table('sekolah')->get(),
            'tabel2' => DB::table('opd')->get()
        ];

        return view('asal.index', compact('data'));
    }

    public function sekolah($id, Request $request)
    {
        $this->checkAdmin(); // Proteksi Admin

        $data = [
            'id' => $id,
            'ketemu' => DB::table('sekolah')->where('sekolah_id', $id)->first(),
        ];

        return view('asal.sekolah', ['data' => $data]);
    }

    public function opd($id, Request $request)
    {
        $this->checkAdmin(); // Proteksi Admin

        $data = [
            'id' => $id,
            'ketemu' => DB::table('opd')->where('opd_id', $id)->first(),
        ];

        return view('asal.opd', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $this->checkAdmin(); // Proteksi Admin (Mencegah submit form dari user biasa)

        $fieldName = ($request->type == 'sekolah') ? 'sekolah_name' : 'opd_name';
        $tableName = ($request->type == 'sekolah') ? 'sekolah' : 'opd';
        $primaryKey = ($request->type == 'sekolah') ? 'sekolah_id' : 'opd_id';

        $request->validate([
            $fieldName => 'required|string|max:255',
        ]);

        $id = $request->id;

        if ($id == 0) {
            DB::table($tableName)->insert([
                $fieldName => $request->$fieldName,
            ]);
            $message = "Data " . strtoupper($request->type) . " berhasil ditambahkan";
        } else {
            DB::table($tableName)->where($primaryKey, $id)->update([
                $fieldName => $request->$fieldName,
            ]);
            $message = "Data " . strtoupper($request->type) . " berhasil diperbarui";
        }

        return redirect()->route('asal.index')->with('success', $message);
    }

    public function hapus($type, $id)
    {
        $this->checkAdmin(); // Proteksi Admin

        return view('asal.hapus', [
            'id'   => $id,
            'type' => $type
        ]);
    }

    public function delete($type, $id)
    {
        $this->checkAdmin(); // Proteksi Admin (Sangat krusial untuk mencegah penghapusan liar)

        $config = [
            'sekolah' => ['table' => 'sekolah', 'pk' => 'sekolah_id'],
            'opd'     => ['table' => 'opd',     'pk' => 'opd_id'],
        ];

        if (array_key_exists($type, $config)) {
            DB::table($config[$type]['table'])
                ->where($config[$type]['pk'], $id)
                ->delete();
        }

        return redirect()->route('asal.index')->with('success', 'Data berhasil dihapus');
    }
}
