@extends('backend.usertemplate')
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
                        <span class="badge bg-info">{{ $item->status_name }}</span>

                        {{-- Logika Tombol Dinamis --}}
                        @if ($item->jumlah_upload == 0)
                            <div class="mt-2">
                                <a href="{{ route('pendaftaran.syarat', $item->pendaftaran_id) }}"
                                    class="btn btn-sm btn-primary rounded-pill">
                                    <i class="bi bi-upload"></i> Upload Berkas Sekarang
                                </a>
                            </div>
                        @else
                            <div class="mt-2">
                                <span class="text-success small"><i class="bi bi-check-circle"></i> Berkas Lengkap</span>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
