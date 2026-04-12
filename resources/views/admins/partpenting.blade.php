@extends('backend.admintemplate')
@section('title', 'Data Kategori, Syarat, dan Status')
@section('content')
    @include('navbars.admin_navbar')
    <div class="card">
        <div class="card-header align-items-center d-flex">
            <h4 class="card-title mb-0 flex-grow-1">List Kategori</h4>
        </div>
        <div class="card-body">
            <table class="table table-striped table-nowrap text-center mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['tabel1'] as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kategori_pelatihan_name }}</td>
                            <td>
                                <a href="{{ route('admins.kategori.buat', ['id' => $item->kategori_pelatihan_id]) }}"
                                    class="btn rounded-pill btn-outline-warning btn-sm waves-effect waves-light"><i
                                        class="ri-edit-2-line label-icon align-middle rounded-pill fs-12 me-1"></i>Edit</a>
                                <a href="{{ route('admins.hapus', ['type' => 'kategori', 'id' => $item->kategori_pelatihan_id]) }}"
                                    class="btn rounded-pill btn-outline-danger btn-sm waves-effect waves-light"><i
                                        class="ri-delete-bin-5-line label-icon align-middle rounded-pill fs-12 me-1"></i>Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <p class="text-end" style="margin-right: 15px">
            <a href="{{ route('admins.kategori.buat', ['id' => 0]) }}"
                class="btn rounded-pill btn-outline-primary waves-effect waves-light"><i
                    class="ri-add-line label-icon align-middle rounded-pill fs-12 me-1"></i>Kategori Baru</a>
        </p>
    </div>
    <div class="row" style="margin-top: 20px">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">List Syarat</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-nowrap text-center mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Syarat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['tabel3'] as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->syarat_name }}</td>
                                    <td>
                                        <a href="{{ route('admins.syarat.bikin', ['id' => $item->syarat_id]) }}"
                                            class="btn rounded-pill btn-outline-warning btn-sm waves-effect waves-light"><i
                                                class="ri-edit-2-line label-icon align-middle rounded-pill fs-12 me-1"></i>Edit</a>
                                        <a href="{{ route('admins.hapus', ['type' => 'syarat', 'id' => $item->syarat_id]) }}"
                                            class="btn rounded-pill btn-outline-danger btn-sm waves-effect waves-light"><i
                                                class="ri-delete-bin-5-line label-icon align-middle rounded-pill fs-12 me-1"></i>Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <p class="text-end" style="margin-right: 15px">
                    <a href="{{ route('admins.syarat.bikin', ['id' => 0]) }}"
                        class="btn rounded-pill btn-outline-primary waves-effect waves-light"><i
                            class="ri-add-line label-icon align-middle rounded-pill fs-12 me-1"></i>Syarat Baru</a>
                </p>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">List Status</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-nowrap text-center mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['tabel4'] as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->status_name }}</td>
                                    <td>
                                        <a href="{{ route('admins.status.create', ['id' => $item->status_id]) }}"
                                            class="btn rounded-pill btn-outline-warning btn-sm waves-effect waves-light"><i
                                                class="ri-edit-2-line label-icon align-middle rounded-pill fs-12 me-1"></i>Edit</a>
                                        <a href="{{ route('admins.hapus', ['type' => 'status', 'id' => $item->status_id]) }}"
                                            class="btn rounded-pill btn-outline-danger btn-sm waves-effect waves-light"><i
                                                class="ri-delete-bin-5-line label-icon align-middle rounded-pill fs-12 me-1"></i>Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <p class="text-end" style="margin-right: 15px">
                    <a href="{{ route('admins.status.create', ['id' => 0]) }}"
                        class="btn rounded-pill btn-outline-primary waves-effect waves-light"><i
                            class="ri-add-line label-icon align-middle rounded-pill fs-12 me-1"></i>Status Baru</a>
                </p>
            </div>
        </div>
    </div>
@endsection
