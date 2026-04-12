@extends('backend.admintemplate')
@section('title', 'Input Sekolah')
@section('content')
    @include('navbars.admin_navbar')
    <h1 class="text-center">{{ $data['id'] == 0 ? 'Input Sekolah' : 'Edit Sekolah' }}</h1>
    <div class="row g-3" style="background: white; padding:20px; border-radius:10px; margin-top:20px;">
        <form class="needs-validation" action="{{ route('sekolah.store') }}" method="POST"
            style="background: white; padding:20px; border-radius:10px; margin-top:20px;" novalidate>
            @csrf
            <input type="hidden" name="type" value="sekolah">
            <input type="hidden" name="id" value="{{ $data['id'] }}">
            <div class="mb-3">
                <label>Nama Sekolah</label>
                <input type="text" class="form-control @error('sekolah_name') is-invalid @enderror"
                    id="sekolah_name" name="sekolah_name" placeholder="Masukkan nama sekolah"
                    value="{{ $data['id'] == 0 ? '' : $data['ketemu']->sekolah_name }}" required>
                <div class="invalid-feedback">Nama sekolah harus diisi</div>
            </div>
            <button type="submit" class="btn rounded-pill btn-outline-primary waves-effect waves-light"><i
                    class="ri-add-line label-icon align-middle rounded-pill fs-12 me-1"></i>Simpan</button>
        </form>
    </div>
@endsection
