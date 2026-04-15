<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mpdf\Mpdf;

class RiwayatController extends Controller
{
    public function index()
    {
        $pesertaId = Auth::user()->peserta_id;

        $riwayat = DB::table('pendaftaran')
            ->join('pelatihan', 'pendaftaran.pelatihan_id', '=', 'pelatihan.pelatihan_id')
            ->join('status', 'pendaftaran.status_id', '=', 'status.status_id')
            ->leftJoin('upload', 'pendaftaran.pendaftaran_id', '=', 'upload.pendaftaran_id')
            ->where('pendaftaran.peserta_id', $pesertaId)
            ->select(
                'pendaftaran.*',
                'pelatihan.pelatihan_name',
                'status.status_name',
                DB::raw('COUNT(upload.pendaftaran_id) as jumlah_upload')
            )
            ->groupBy(
                'pendaftaran.pendaftaran_id',
                'pelatihan.pelatihan_name',
                'status.status_name',
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

    public function bukti($id)
    {
        $data = DB::table('pendaftaran')
            ->join('peserta', 'pendaftaran.peserta_id', '=', 'peserta.peserta_id')
            ->join('pelatihan', 'pendaftaran.pelatihan_id', '=', 'pelatihan.pelatihan_id')
            ->leftJoin('sekolah', 'peserta.sekolah_id', '=', 'sekolah.sekolah_id')
            ->leftJoin('opd', 'peserta.opd_id', '=', 'opd.opd_id')
            ->select(
                'pendaftaran.*',
                'peserta.*',
                'peserta.peserta_nisn',
                'pelatihan.pelatihan_name',
                'sekolah.sekolah_name',
                'opd.opd_name'
            )
            ->where('pendaftaran.pendaftaran_id', $id)
            ->first();

        if (!$data) return redirect()->back();

        // Logika Path Foto
        $pathFoto = '';
        if (!empty($data->peserta_foto)) {
            $fullPath = storage_path('app/public/' . $data->peserta_foto);
            if (file_exists($fullPath)) {
                $pathFoto = $fullPath;
            }
        }

        if (empty($pathFoto)) {
            $pathFoto = public_path('nova/img/user.png');
        }

        $html = view('riwayat.bukti', compact('data', 'pathFoto'))->render();

        $mpdf = new \Mpdf\Mpdf(['margin_left' => 10, 'margin_right' => 10]);
        $mpdf->WriteHTML($html);

        // --- BAGIAN PERUBAHAN NAMA FILE ---
        $pelatihan = $data->pelatihan_name;
        $namaPeserta = $data->peserta_nama_lengkap ?? $data->peserta_name;

        // Membersihkan karakter yang tidak diperbolehkan dalam nama file
        $fileName = "Bukti Pendaftaran " . $pelatihan . " " . $namaPeserta . ".pdf";
        $fileName = str_replace(['/', '\\', ':', '*', '?', '"', '<', '>', '|'], '-', $fileName);

        return $mpdf->Output($fileName, 'I');
    }
}
