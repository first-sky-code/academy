@extends('backend.admintemplate')
@section('content')
    @include('navbars.admin_navbar')
    <h1 class="text-center">{{ $data['id'] == 0 ? 'Input Mentor' : 'Edit Mentor' }}</h1>
    <div class="row g-3" style="background: white; padding:20px; border-radius:10px; margin-top:20px;">
        <form class="needs-validation" action="{{ route('admins.mentor.store') }}" method="POST"
            style="background: white; padding:20px; border-radius:10px; margin-top:20px;" novalidate>
            @csrf
            <input type="hidden" name="type" value="admins.mentor">
            <input type="hidden" name="id" value="{{ $data['id'] }}">
            <div class="mb-3">
                <label>Nama Mentor</label>
                <input type="text" class="form-control @error('mentor_name') is-invalid @enderror" id="mentor_name"
                    name="mentor_name" placeholder="Masukkan nama mentor"
                    value="{{ $data['id'] == 0 ? '' : $data['ketemu']->mentor_name }}" required>
                <div class="invalid-feedback">Nama mentor harus diisi</div>
            </div>
            <div class="mb-3">
                <label>Jabatan Mentor</label>
                <input type="text" class="form-control @error('mentor_jabatan') is-invalid @enderror" id="mentor_jabatan"
                    name="mentor_jabatan" placeholder="Masukkan jabatan mentor"
                    value="{{ $data['id'] == 0 ? '' : $data['ketemu']->mentor_jabatan }}" required>
                <div class="invalid-feedback">Jabatan mentor harus diisi</div>
            </div>
            <button type="submit" class="btn rounded-pill btn-outline-primary waves-effect waves-light"><i
                    class="ri-add-line label-icon align-middle rounded-pill fs-12 me-1"></i>Simpan</button>
        </form>
    </div>
@endsection
