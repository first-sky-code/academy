@extends('backend.usertemplate')
@section('content')
    @include('navbars.landing_navbar')
    <h5 class="text-center mt-4">Langkah Terakhir: Unggah Persyaratan</h5>
    <h4 class="text-center text-primary">{{ $pendaftaran->pelatihan_name }}</h4>

    <div class="card shadow rounded mt-4">
        <div class="card-body">
            <div class="alert alert-info border-0 rounded-pill text-center mb-4">
                Pendaftaran Anda berhasil dicatat! Silakan lengkapi dokumen di bawah ini.
            </div>

            <form action="{{ route('pendaftaran.upload', $pendaftaran->pendaftaran_id) }}" method="POST"
                enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    @foreach ($syaratList as $s)
                        <div class="col-md-12 mb-4">
                            <label class="form-label fw-bold">Upload {{ $s->syarat_name }}</label>
                            <input type="file" name="file_syarat[{{ $s->syarat_id }}]"
                                class="form-control @error('file_syarat.' . $s->syarat_id) is-invalid @enderror"
                                accept=".jpg,.jpeg,.png,.pdf" required>

                            @error('file_syarat.' . $s->syarat_id)
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Format: JPG, PNG, PDF (Maks. 500KB)</div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success rounded-pill px-5">
                        <i class="ri-upload-cloud-2-line me-1"></i> Simpan Persyaratan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
