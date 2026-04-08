<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    public function admins()
    {
        // KEAMANAN: Jika bukan admin, tendang keluar
        if (Auth::user()->usertype !== 'admin') {
            return redirect()->route('admins.landing')->with('error', 'Akses ditolak!');
        }

        $data = [
            'tabel' => DB::table('users')->get(),
        ];
        return view('admins.akun_admin', ['data' => $data]);
    }

    public function edit($id) // Tambahkan parameter $id di sini
    {
        // KEAMANAN: Hanya admin yang boleh mengedit akun orang lain
        if (Auth::user()->usertype !== 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak!');
        }

        $data = [
            'id' => $id,
            'ketemu' => DB::table('users')->where('id', $id)->first(),
        ];

        return view('admins.akun_edit', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $id = $request->id; // Ambil ID dari input hidden di form

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'usertype' => 'required|string|max:255',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'usertype' => $request->usertype,
        ];

        // Hanya update password jika diisi (agar tidak ter-reset jadi kosong)
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        DB::table('users')->where('id', $id)->update($updateData);

        return redirect()->route('admins.akun_admin')->with('success', 'Data berhasil diperbarui');
    }
}
