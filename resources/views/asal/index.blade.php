@extends('backend.admintemplate')
@section('title', 'Data Asal Sekolah & OPD')
@section('content')
    @include('navbars.admin_navbar')
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">List Sekolah</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-nowrap text-center mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Sekolah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['tabel1'] as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->sekolah_name }}</td>
                                    <td>
                                        <a href="{{ route('asal.sekolah', ['id' => $item->sekolah_id]) }}"
                                            class="btn rounded-pill btn-outline-warning btn-sm waves-effect waves-light"><i
                                                class="ri-edit-2-line label-icon align-middle rounded-pill fs-12 me-1"></i>Edit</a>
                                        <a href="{{ route('asal.hapus', ['type' => 'sekolah', 'id' => $item->sekolah_id]) }}"
                                            class="btn rounded-pill btn-outline-danger btn-sm waves-effect waves-light"><i
                                                class="ri-delete-bin-5-line label-icon align-middle rounded-pill fs-12 me-1"></i>Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <p class="text-end" style="margin-right: 15px">
                    <a href="{{ route('asal.sekolah', ['id' => 0]) }}"
                        class="btn rounded-pill btn-outline-primary waves-effect waves-light"><i
                            class="ri-add-line label-icon align-middle rounded-pill fs-12 me-1"></i>Sekolah Baru</a>
                </p>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">List OPD</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-nowrap text-center mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama OPD</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['tabel2'] as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->opd_name }}</td>
                                    <td>
                                        <a href="{{ route('asal.opd', ['id' => $item->opd_id]) }}"
                                            class="btn rounded-pill btn-outline-warning btn-sm waves-effect waves-light"><i
                                                class="ri-edit-2-line label-icon align-middle rounded-pill fs-12 me-1"></i>Edit</a>
                                        <a href="{{ route('asal.hapus', ['type' => 'opd', 'id' => $item->opd_id]) }}"
                                            class="btn rounded-pill btn-outline-danger btn-sm waves-effect waves-light"><i
                                                class="ri-delete-bin-5-line label-icon align-middle rounded-pill fs-12 me-1"></i>Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <p class="text-end" style="margin-right: 15px">
                    <a href="{{ route('asal.opd', ['id' => 0]) }}"
                        class="btn rounded-pill btn-outline-primary waves-effect waves-light"><i
                            class="ri-add-line label-icon align-middle rounded-pill fs-12 me-1"></i>OPD Baru</a>
                </p>
            </div>
        </div>
    </div>
@endsection
