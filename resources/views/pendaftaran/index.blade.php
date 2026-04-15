@extends('backend.usertemplate')
@section('title', 'Pelatihan ' . $data['tabel1']->pelatihan_name)
@section('content')
    @include('navbars.landing_navbar')
    <h5 class="text-center">Selamat Datang di Halaman Pendaftaran</h5>
    <h4 class="text-center">{{ $data['tabel1']->pelatihan_name }}</h4>
    <div class="card shadow rounded mt-4">
        <div class="card-body">
            <form class="needs-validation" action="{{ route('pendaftaran.store', $data['id']) }}" method="POST"
                style="background: white; padding:20px; border-radius:10px; margin-top:20px;" novalidate>
                @csrf
                <input type="hidden" name="id" value="{{ $data['id'] }}">
                <div class=" mb-4">
                    <p style="text-align: center">Halo Semua! Sudah siap untuk mengikuti pelatihan
                        <strong>{{ $data['tabel1']->pelatihan_name }}</strong> ini?
                    </p>
                    <div class="bg-light p-3 rounded my-3">
                        <div>
                            {!! $data['tabel1']->pelatihan_tatacara !!}
                        </div>
                    </div>
                    <p style="text-align: center">Tunggu apa lagi? Ayo Daftar Sekarang!</p>
                </div>

                <hr>

                <div class="d-flex flex-column align-items-center mt-3">
                    <h6 class="text-secondary mb-3 pb-1" style="border-bottom: 2px solid #0d6efd; display: inline-block;">
                        Informasi Jadwal Pelatihan
                    </h6>

                    <table class="table table-sm table-borderless w-auto mb-0">
                        <tbody>
                            <tr>
                                <td class="fw-bold pe-3">Registrasi</td>
                                <td class="px-2">:</td>
                                <td class="text-muted">
                                    {{ $data['tabel1']->pelatihan_mulai }} <span class="mx-1">s/d</span>
                                    {{ $data['tabel1']->pelatihan_tutup }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-primary fw-bold pe-3">Pelaksanaan</td>
                                <td class="text-primary px-2">:</td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                                        {{ $data['tabel1']->pelatihan_jadwal }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                @php
                    $hari_ini = \Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->startOfDay();
                    $tgl_mulai = \Carbon\Carbon::parse($data['tabel1']->pelatihan_mulai)->startOfDay();
                    $tgl_tutup = \Carbon\Carbon::parse($data['tabel1']->pelatihan_tutup)->startOfDay();
                @endphp

                <p class="text-center">
                    {{-- 1. Cek apakah user sudah login atau belum (Utamakan Login) --}}
                    @guest('web')
                        <a href="/auth-google-redirect"
                            class="btn rounded-pill btn-outline-primary waves-effect waves-light mt-4">
                            <i class="ri-google-fill label-icon align-middle rounded-pill fs-12 me-1"></i>
                            Login untuk Daftar
                        </a>
                    @else
                        {{-- 2. Jika sudah login, baru cek status pendaftaran --}}
                        @if ($data['sudah_daftar'])
                            <button type="button" class="btn rounded-pill btn-success mt-4" disabled>
                                <i class="ri-checkbox-circle-line label-icon align-middle rounded-pill fs-12 me-1"></i>
                                Anda Sudah Terdaftar
                            </button>
                        @elseif ($hari_ini->greaterThanOrEqualTo($tgl_mulai) && $hari_ini->lessThanOrEqualTo($tgl_tutup))
                            <button type="submit" class="btn rounded-pill btn-primary waves-effect waves-light mt-4 px-5">
                                <i class="ri-check-line label-icon align-middle rounded-pill fs-12 me-1"></i>
                                Klik Untuk Daftar
                            </button>
                        @elseif ($hari_ini->lessThan($tgl_mulai))
                            <button type="button" class="btn rounded-pill btn-outline-secondary mt-4" disabled>
                                Pendaftaran Belum Dibuka
                            </button>
                        @else
                            <button type="button" class="btn rounded-pill btn-outline-danger mt-4" disabled>
                                Pendaftaran Sudah Ditutup
                            </button>
                        @endif
                    @endguest
                </p>
            </form>
        </div>
    </div>
@endsection
