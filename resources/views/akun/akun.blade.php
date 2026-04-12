@extends('backend.usertemplate')
@section('title', 'Akun Saya')
@section('content')
    @include('navbars.landing_navbar')

    <style>
        .profile-nav {
            display: flex;
            gap: 20px;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 25px;
            padding-bottom: 10px;
        }

        .profile-nav a {
            color: #6c757d;
            text-decoration: none;
            font-size: 14px;
        }

        .profile-nav .active {
            color: #007bff;
            font-weight: bold;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }

        .avatar-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #007bff;
            padding: 2px;
        }

        .info-label {
            color: #6c757d;
            font-size: 13px;
            margin-bottom: 0;
        }

        .info-value {
            color: #212529;
            font-weight: 600;
            margin-bottom: 15px;
            text-transform: uppercase;
        }
    </style>

    <div class="container mt-4">
        <div class="card shadow-sm p-4">

            @foreach ($data['isi'] as $item)
                <div class="row align-items-center">
                    <div class="col-md-4 text-center border-end">
                        <div class="position-relative d-inline-block">
                            @if ($item->peserta_foto)
                                <img src="{{ asset('storage/' . $item->peserta_foto) }}" class="avatar-img" alt="Foto">
                            @else
                                <img src="{{ asset('nova/img/user.png') }}" class="avatar-img" alt="Default">
                            @endif
                        </div>
                        <p class="mt-3 text-muted small px-3">
                            Foto yang diupload adalah foto formal terbaru. Disarankan menggunakan background transparan.
                        </p>
                    </div>

                    <div class="col-md-8 ps-md-5">
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="info-label">Nama Lengkap</p>
                                <p class="info-value">{{ $item->peserta_nama_lengkap ?? 'Belum diisi' }}</p>

                                <p class="info-label">
                                    @if ($item->peserta_nisn)
                                        NISN (Siswa)
                                    @elseif($item->peserta_nip)
                                        NIP (Pegawai)
                                    @else
                                        Identitas (NIP/NISN)
                                    @endif
                                </p>
                                <p class="info-value">
                                    @if ($item->peserta_nisn)
                                        {{ $item->peserta_nisn }}
                                    @elseif($item->peserta_nip)
                                        {{ $item->peserta_nip }}
                                    @else
                                        -
                                    @endif
                                </p>

                                <p class="info-label">
                                    @if ($item->sekolah_name)
                                        Asal Sekolah
                                    @elseif($item->opd_name)
                                        Asal OPD
                                    @else
                                        Asal Instansi
                                    @endif
                                </p>
                                <p class="info-value text-primary">
                                    {{-- Logika untuk menampilkan nama sekolah atau OPD --}}
                                    @if ($item->sekolah_name)
                                        {{ $item->sekolah_name }}
                                    @elseif($item->opd_name)
                                        {{ $item->opd_name }}
                                    @else
                                        {{ $item->peserta_asal_instansi ?? '-' }}
                                    @endif
                                </p>
                            </div>

                            <div class="col-sm-6">
                                <p class="info-label">Nomor HP</p>
                                <p class="info-value">{{ $item->peserta_no_hp ?? '-' }}</p>

                                <p class="info-label">Tempat / Tanggal Lahir</p>
                                <p class="info-value">
                                    {{ $item->peserta_tempat_lahir ?? '-' }} /
                                    {{ $item->peserta_tanggal_lahir ? \Carbon\Carbon::parse($item->peserta_tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                                </p>

                                <p class="info-label">Alamat</p>
                                <p class="info-value">{{ $item->peserta_alamat ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="mt-4 pt-3 border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <small><b>Catatan:</b> Data ini akan digunakan untuk pendaftaran pelatihan dan sertifikat.</small>
                    <div>
                        <a href="{{ route('peserta.beranda') }}#pelatihan"
                            class="btn btn-outline-primary rounded-pill px-4">Pilih
                            Pelatihan</a>
                        {{-- <a href="{{ route('akun.edit') }}" class="btn btn-outline-secondary rounded-pill px-4">Edit
                            Akun</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
