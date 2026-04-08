@extends('backend.admintemplate')
@section('content')
    @include('navbars.admin_navbar')
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Halaman Data Pendaftar</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped text-center mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelatihan</th>
                        {{-- Kolom Pemilik Data hanya muncul untuk Admin --}}
                        @if (auth()->user()->usertype == 'admin')
                            <th>Pemilik Data</th>
                        @endif
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_pelatihan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->pelatihan_name }}</td>

                            @if (auth()->user()->usertype == 'admin')
                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ $item->nama_pemilik ?? 'Tidak Diketahui' }}
                                    </span>
                                </td>
                            @endif

                            <td>
                                <a href="{{ route('partisipan.detail', $item->pelatihan_id) }}" class="btn btn-info btn-sm">
                                    <i class="ri-eye-line"></i> Lihat Pendaftar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
