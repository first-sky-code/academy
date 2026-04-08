@extends('backend.admintemplate')
@section('content')
    @include('navbars.admin_navbar')
    <h1 class="text-center">{{ $data['id'] == 0 ? 'Input Kategori' : 'Edit Kategori' }}</h1>
    <div class="row g-3" style="background: white; padding:20px; border-radius:10px; margin-top:20px;">
        <form class="needs-validation" action="{{ route('admins.kategori.store') }}" method="POST"
            style="background: white; padding:20px; border-radius:10px; margin-top:20px;" novalidate>
            @csrf
            <input type="hidden" name="type" value="admins.kategori">
            <input type="hidden" name="id" value="{{ $data['id'] }}">
            <div class="mb-3">
                <label>Nama Kategori</label>
                <input type="text" class="form-control @error('kategori_pelatihan_name') is-invalid @enderror"
                    id="kategori_pelatihan_name" name="kategori_pelatihan_name" placeholder="Masukkan nama kategori"
                    value="{{ $data['id'] == 0 ? '' : $data['ketemu']->kategori_pelatihan_name }}" required>
                <div class="invalid-feedback">Kategori harus diisi</div>
            </div>
            <button type="submit" class="btn rounded-pill btn-outline-primary waves-effect waves-light"><i
                    class="ri-add-line label-icon align-middle rounded-pill fs-12 me-1"></i>Simpan</button>
        </form>
    </div>
@endsection
