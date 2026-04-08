@extends('backend.admintemplate')
@section('content')
    @include('navbars.admin_navbar')
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">List Pelatihan</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped text-center mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelatihan</th>
                        @if (Auth::user()->usertype == 'admin')
                            <th>Pembuat</th> {{-- Kolom tambahan untuk Admin --}}
                        @endif
                        <th>Kategori</th>
                        <th>Syarat</th>
                        <th>Mulai</th>
                        <th>Tutup</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['tabel'] as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->pelatihan_name }}</td>

                            @if (Auth::user()->usertype == 'admin')
                                <td><span class="badge bg-secondary">{{ $item->nama_pembuat }}</span></td>
                            @endif

                            <td>{{ $item->kategori_pelatihan_name }}</td>
                            <td>{{ $item->daftar_syarat }}</td>
                            <td>{{ $item->pelatihan_mulai }}</td>
                            <td>{{ $item->pelatihan_tutup }}</td>
                            <td>
                                {{-- Tombol aksi tetap sama --}}
                                <a href="{{ route('pelatihan.input', ['id' => $item->pelatihan_id]) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{ route('pelatihan.hapus', $item->pelatihan_id) }}"
                                    class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <p class="text-end" style="margin-right: 15px">
            <a href="{{ route('pelatihan.input', ['id' => 0]) }}"
                class="btn rounded-pill btn-outline-primary waves-effect waves-light"><i
                    class="ri-add-line label-icon align-middle rounded-pill fs-12 me-1"></i>Pelatihan Baru</a>
        </p>
    </div>
@endsection
