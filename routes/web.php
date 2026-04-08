<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\PelatihanController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\AsalController;
use App\Http\Controllers\PartPentingController;
use App\Http\Controllers\PesertaAuthController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartisipanController;

// Route::get('/', function () {
//     return view('home');
// })->name('home');
Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/pendaftaran/{id}', [PendaftaranController::class, 'index'])->name('pendaftaran.index');

Route::get('/auth-google-redirect', [PesertaAuthController::class, 'google_redirect']);
Route::get('/auth-google-callback', [PesertaAuthController::class, 'google_callback']);

// --- LOGIN & REGISTER PESERTA (Manual) ---
Route::controller(PesertaAuthController::class)->group(function () {
    // Route::get('/user/login', 'showLogin')->name('user.login');
    // Route::post('/user/login', 'login')->name('user.login.submit');
    // Route::get('/user/register', 'showRegister')->name('user.register');
    // Route::post('/user/register', 'register')->name('user.register.store');
    Route::post('/user/logout', 'logout')->name('user.logout');
});

Route::get('/signin', function () {
    return view('admins.signin');
})->name('signin');

Route::get('/signup', function () {
    return view('admins.signup');
})->name('signup');

//

Route::middleware('auth:admin', 'verified')->group(function () {

    Route::get('/landing', function () {
        return view('admins.landing');
    })->name('admins.landing');

    Route::controller(AdminsController::class)->group(function () {
        Route::get('/admins', 'admins')->name('admins.akun_admin');
        Route::get('/admins/edit/{id}', 'edit')->name('admins.akun_edit');
        Route::post('/admins/store', 'store')->name('admins.akun_store');
    });

    Route::controller(PartPentingController::class)->group(function () {
        Route::get('/part-penting', 'partpenting')->name('admins.partpenting');
        Route::get('/kategori/buat/{id}', 'buat')->name('admins.kategori.buat');
        Route::post('/kategori/store', 'store')->name('admins.kategori.store');
        Route::get('/part-penting/input/{id}', 'input')->name('admins.mentor.input');
        Route::post('/part-penting/store', 'store')->name('admins.mentor.store');
        Route::get('/syarat/bikin/{id}', 'bikin')->name('admins.syarat.bikin');
        Route::post('/syarat/store', 'store')->name('admins.syarat.store');
        Route::get('/status/create/{id}', 'create')->name('admins.status.create');
        Route::post('/status/store', 'store')->name('admins.status.store');
        Route::get('/part-penting/hapus/{type}/{id}', 'hapus')->name('admins.hapus');
        Route::delete('/part-penting/delete/{type}/{id}', 'delete')->name('admins.delete');
    });

    Route::controller(PelatihanController::class)->group(function () {
        Route::get('/pelatihan', 'pelatihan')->name('pelatihan.pelatihan');
        Route::get('/pelatihan/input/{id}', 'input')->name('pelatihan.input');
        Route::post('/pelatihan/store', 'store')->name('pelatihan.store');
        Route::get('/pelatihan/hapus/{id}', 'hapus')->name('pelatihan.hapus');
        Route::delete('/pelatihan/delete', 'delete')->name('pelatihan.delete');
    });

    Route::controller(PartisipanController::class)->group(function () {
        Route::get('/partisipan', 'index')->name('partisipan.index');
        Route::get('/partisipan/edit/{id}', 'edit')->name('partisipan.edit');
        Route::post('/partisipan/update/{id}', 'update')->name('partisipan.update');
        Route::get('/partisipan/{id}', 'showPendaftar')->name('partisipan.detail');
    });

    Route::controller(AsalController::class)->group(function () {
        Route::get('/asal', 'index')->name('asal.index');
        Route::get('/asal/sekolah/{id}', 'sekolah')->name('asal.sekolah');
        Route::post('/asal/sekolah/store', 'store')->name('sekolah.store');
        Route::get('/asal/opd/{id}', 'opd')->name('asal.opd');
        Route::post('/asal/opd/store', 'store')->name('opd.store');
        Route::get('/asal/hapus/{type}/{id}', 'hapus')->name('asal.hapus');
        Route::delete('/asal/delete/{type}/{id}', 'delete')->name('asal.delete');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth:web')->group(function () {
    // Route::get('/beranda', function () {
    //     return view('peserta.beranda');
    // })->name('peserta.beranda');

    Route::get('/beranda', [BerandaController::class, 'index'])->name('peserta.beranda');

    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');

    Route::controller(PendaftaranController::class)->group(function () {
        Route::post('/pendaftaran/{id}/store', 'store')->name('pendaftaran.store');
        Route::get('/pendaftaran/syarat/{pendaftaranId}', 'inputSyarat')->name('pendaftaran.syarat');
        Route::post('/pendaftaran/syarat/{pendaftaranId}/upload', 'storeSyarat')->name('pendaftaran.input');
        Route::post('/pendaftaran/syarat/{pendaftaranId}/upload', 'storeSyarat')->name('pendaftaran.upload');
    });

    Route::controller(AkunController::class)->group(function () {
        Route::get('/akun', 'akun')->name('akun.akun');
        Route::get('/akun/edit', 'edit')->name('akun.edit');
        Route::post('/akun/update', 'store')->name('akun.update');
    });
});

require __DIR__ . '/auth.php';
