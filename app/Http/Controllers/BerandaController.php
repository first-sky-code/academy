<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    public function index()
    {
        $pelatihan = DB::table('pelatihan')
            ->get();

        return view('peserta.beranda', compact('pelatihan'));
    }
}
