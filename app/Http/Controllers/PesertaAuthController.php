<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class PesertaAuthController extends Controller
{
    protected $guard = 'web';
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'peserta_email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'peserta_email' => $request->peserta_email,
            'password' => $request->password,
        ];

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('peserta.beranda');
        }

        return back()->withErrors([
            'peserta_email' => 'Email atau password salah.',
        ])->onlyInput('peserta_email');
    }

    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'peserta_name' => 'required|string|max:255',
            'peserta_email' => 'required|string|email|max:255|unique:peserta,peserta_email',
            'peserta_password' => 'required|string|min:8|confirmed',
        ]);

        $peserta = Peserta::create([
            'peserta_name' => $request->peserta_name,
            'peserta_email' => $request->peserta_email,
            'peserta_password' => Hash::make($request->peserta_password),
            'usertype' => 'peserta',
        ]);

        Auth::guard('web')->login($peserta);
        return redirect()->route('akun.edit');
    }

    public function google_redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_callback()
    {
        // try {
        // Tetap gunakan stateless() agar tidak error InvalidState di localhost
        $googleUser = Socialite::driver('google')->user();

        // Cari dulu untuk mengecek password lama
        $existingPeserta = Peserta::where('peserta_email', $googleUser->getEmail())->first();

        $peserta = Peserta::updateOrCreate(
            ['peserta_email' => $googleUser->getEmail()],
            [
                'peserta_name' => $googleUser->getName(),
                'peserta_google_id' => $googleUser->getId(),
                'usertype' => 'peserta',
                // Ambil password lama jika ada, jika tidak ada buat baru
                'peserta_password' => $existingPeserta->peserta_password ?? Hash::make(uniqid()),
            ]
        );

        Auth::guard('web')->login($peserta);
        // dd(Auth::check());

        // Cek kelengkapan data
        if (
            empty($peserta->peserta_nama_lengkap) ||
            empty($peserta->peserta_alamat) ||
            empty($peserta->peserta_no_hp) ||
            empty($peserta->peserta_foto)
        ) {
            return redirect()->route('akun.edit')->with('info', 'Silakan lengkapi profil Anda.');
        }

        return redirect()->route('peserta.beranda');
        // } catch (\Exception $e) {
        //     // Jika ada error, kita bisa melihatnya lewat dd
        //     return dd($e);
        // }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
