<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RiwayatController extends Controller
{
    public function index()
    {
        $pesertaId = Auth::user()->peserta_id;

        $riwayat = DB::table('pendaftaran')
            ->join('pelatihan', 'pendaftaran.pelatihan_id', '=', 'pelatihan.pelatihan_id')
            ->join('status', 'pendaftaran.status_id', '=', 'status.status_id')
            // Menggunakan leftJoin ke tabel upload untuk mengecek keberadaan berkas
            ->leftJoin('upload', 'pendaftaran.pendaftaran_id', '=', 'upload.pendaftaran_id')
            ->where('pendaftaran.peserta_id', $pesertaId)
            ->select(
                'pendaftaran.*', 
                'pelatihan.pelatihan_name', 
                'status.status_name',
                // Menghitung jumlah file yang sudah diunggah untuk pendaftaran ini
                DB::raw('COUNT(upload.pendaftaran_id) as jumlah_upload') 
            )
            ->groupBy(
                'pendaftaran.pendaftaran_id', 
                'pelatihan.pelatihan_name', 
                'status.status_name',
                // Masukkan semua kolom pendaftaran yang ada di select ke groupBy jika menggunakan MySQL mode strict
                'pendaftaran.peserta_id',
                'pendaftaran.pelatihan_id',
                'pendaftaran.status_id',
                'pendaftaran.pendaftaran_catatan',
                'pendaftaran.created_at',
                'pendaftaran.updated_at'
            )
            ->get();

        return view('riwayat.index', compact('riwayat'));
    }
}