<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PartPentingController extends Controller
{
    public function partpenting()
    {
        if (Auth::user()->usertype !== 'admin') {
            return redirect()->route('admins.landing')->with('error', 'Akses ditolak!');
        }


        $data = [
            'tabel1' => DB::table('kategori_pelatihan')->get(),
            'tabel2' => DB::table('mentor')->get(),
            'tabel3' => DB::table('syarat')->get(),
            'tabel4' => DB::table('status')->get(),
        ];
        return view('admins.partpenting', ['data' => $data]);
    }
    public function buat(Request $request)
    {
        if (Auth::user()->usertype !== 'admin') {
            return redirect()->route('admins.landing')->with('error', 'Akses ditolak!');
        }

        $data = [
            'id' => $request->id,
            'ketemu' => DB::table('kategori_pelatihan')->where('kategori_pelatihan_id', $request->id)->get()->first(),
        ];
        return view('admins.kategori.buat', ['data' => $data]);
    }
    public function input(Request $request)
    {
        if (Auth::user()->usertype !== 'admin') {
            return redirect()->route('admins.landing')->with('error', 'Akses ditolak!');
        }

        $data = [
            'id' => $request->id,
            'ketemu' => DB::table('mentor')->where('mentor_id', $request->id)->get()->first(),
        ];
        return view('admins.mentor.input', ['data' => $data]);
    }
    public function bikin(Request $request)
    {
        if (Auth::user()->usertype !== 'admin') {
            return redirect()->route('admins.landing')->with('error', 'Akses ditolak!');
        }

        $data = [
            'id' => $request->id,
            'ketemu' => DB::table('syarat')->where('syarat_id', $request->id)->get()->first(),
        ];
        return view('admins.syarat.bikin', ['data' => $data]);
    }
    public function create(Request $request)
    {
        if (Auth::user()->usertype !== 'admin') {
            return redirect()->route('admins.landing')->with('error', 'Akses ditolak!');
        }

        $data = [
            'id' => $request->id,
            'ketemu' => DB::table('status')->where('status_id', $request->id)->get()->first(),
        ];
        return view('admins.status.create', ['data' => $data]);
    }
    public function store(Request $request)
    {

        $type = str_replace('admins.', '', $request->type);
        $id = $request->id;

        $config = [
            'kategori' => [
                'table' => 'kategori_pelatihan',
                'pk'    => 'kategori_pelatihan_id',
                'fields' => ['kategori_pelatihan_name' => $request->kategori_pelatihan_name]
            ],
            'mentor' => [
                'table' => 'mentor',
                'pk'    => 'mentor_id',
                'fields' => [
                    'mentor_name' => $request->mentor_name,
                    'mentor_jabatan'   => $request->mentor_jabatan
                ]
            ],
            'syarat' => [
                'table' => 'syarat',
                'pk'    => 'syarat_id',
                'fields' => ['syarat_name' => $request->syarat_name]
            ],
            'status' => [
                'table' => 'status',
                'pk'    => 'status_id',
                'fields' => ['status_name' => $request->status_name]
            ],
        ];

        if (!array_key_exists($type, $config)) {
            return redirect()->back();
        }

        $currentConfig = $config[$type];
        $data = $currentConfig['fields'];

        if ($id == 0) {
            DB::table($currentConfig['table'])->insert($data);
        } else {
            DB::table($currentConfig['table'])
                ->where($currentConfig['pk'], $id)
                ->update($data);
        }

        return redirect()->route('admins.partpenting');
    }
    public function hapus($type, $id)
    {
        if (Auth::user()->usertype !== 'admin') {
            return redirect()->route('admins.landing')->with('error', 'Akses ditolak!');
        }

        return view('admins.hapus', [
            'id'   => $id,
            'type' => $type
        ]);
    }

    public function delete($type, $id)
    {
        $config = [
            'kategori' => ['table' => 'kategori_pelatihan', 'pk' => 'kategori_pelatihan_id'],
            'mentor'   => ['table' => 'mentor',             'pk' => 'mentor_id'],
            'syarat'   => ['table' => 'syarat',             'pk' => 'syarat_id'],
            'status'   => ['table' => 'status',             'pk' => 'status_id'],
        ];

        if (array_key_exists($type, $config)) {
            DB::table($config[$type]['table'])
                ->where($config[$type]['pk'], $id)
                ->delete();
        }

        return redirect()->route('admins.partpenting');
    }
}
