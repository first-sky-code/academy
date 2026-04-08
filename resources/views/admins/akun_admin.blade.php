@extends('backend.admintemplate')
@section('content')
    @include('navbars.admin_navbar')
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">Daftar Akun Admin</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped table-nowrap text-center mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Tipe User</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['tabel'] as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->usertype }}</td>
                            <td><a href="{{ route('admins.akun_edit', ['id' => $item->id]) }}"
                                    class="btn rounded-pill btn-outline-warning btn-sm waves-effect waves-light"><i
                                        class="ri-edit-2-line label-icon align-middle rounded-pill fs-12 me-1"></i>Edit</a>
                                {{-- <a href="{{ route('category.hapus', $item->categories_id) }}"
                                            class="btn rounded-pill btn-outline-danger btn-sm waves-effect waves-light"><i
                                                class="ri-delete-bin-5-line label-icon align-middle rounded-pill fs-12 me-1"></i>Hapus</a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- <p class="text-end" style="margin-right: 15px">
                    <a href="{{ route('category.input', ['id' => 0]) }}"
                        class="btn rounded-pill btn-outline-primary waves-effect waves-light"><i
                            class="ri-add-line label-icon align-middle rounded-pill fs-12 me-1"></i>Kategori Baru</a>
                </p> --}}
    </div>
@endsection
