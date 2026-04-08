@extends('backend.admintemplate')
@section('content')
    @include('navbars.admin_navbar')
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4>Daftar Peserta Pelatihan: {{ $pelatihan->pelatihan_name }}</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Peserta</th>
                        <th>Kontak & Alamat</th>
                        <th>Dokumen Syarat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendaftar as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $p->peserta_name }}</td>
                            <td>
                                {{ $p->peserta_no_hp }} <br>
                                <small class="text-muted">{{ $p->peserta_alamat }}</small>
                            </td>
                            <td>
                                {{-- PERBAIKAN: Mengambil file dari variabel $uploads --}}
                                @if (isset($uploads[$p->pendaftaran_id]))
                                    @foreach ($uploads[$p->pendaftaran_id] as $file)
                                        <a href="{{ asset('storage/' . $file->nama_file) }}" target="_blank"
                                            class="badge bg-primary mb-1 d-inline-block">
                                            <i class="ri-file-text-line"></i> {{ $file->syarat_name }}
                                        </a><br>
                                    @endforeach
                                @else
                                    <span class="text-muted small">Belum upload berkas</span>
                                @endif
                            </td>
                            <td>
                                {{-- Menampilkan Status --}}
                                <span class="badge bg-info mb-1">{{ $p->status_name }}</span><br>

                                {{-- Tombol Edit --}}
                                <a href="{{ route('partisipan.edit', $p->pendaftaran_id) }}" class="btn btn-warning btn-sm">
                                    <i class="ri-edit-box-line"></i> Edit Status
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada peserta yang mendaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection
