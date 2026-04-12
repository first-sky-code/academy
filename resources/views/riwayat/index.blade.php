@extends('backend.usertemplate')
@section('title', 'Riwayat Pendaftaran Pelatihan')
@section('content')
    @include('navbars.landing_navbar')
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelatihan</th>
                <th>Catatan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($riwayat as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->pelatihan_name }}</td>
                    <td>{{ $item->pendaftaran_catatan }}</td>
                    <td>
                        <span class="badge bg-info mb-2">{{ $item->status_name }}</span>

                        {{-- Kondisi 1: Jika belum upload berkas --}}
                        @if ($item->jumlah_upload == 0)
                            <div class="mt-2">
                                <a href="{{ route('pendaftaran.syarat', $item->pendaftaran_id) }}"
                                    class="btn btn-sm btn-primary rounded-pill">
                                    <i class="bi bi-upload"></i> Upload Berkas Sekarang
                                </a>
                            </div>

                            {{-- Kondisi 2: Jika sudah upload berkas --}}
                        @else
                            <div class="mt-2">
                                @if ($item->status_name == 'Pendaftaran Diterima')
                                    {{-- Jika diterima, "Berkas Lengkap" berubah jadi tombol PDF --}}
                                    <a href="{{ route('riwayat.bukti', $item->pendaftaran_id) }}"
                                        class="btn btn-sm btn-success rounded-pill" target="_blank">
                                        <i class="bi bi-file-pdf"></i> Berkas Lengkap (Cetak PDF)
                                    </a>
                                @else
                                    {{-- Jika belum diterima, hanya teks biasa --}}
                                    <span class="text-success small">
                                        <i class="bi bi-check-circle"></i> Berkas Lengkap
                                    </span>
                                @endif
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
