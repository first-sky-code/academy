@extends('backend.admintemplate')
@section('content')
    @include('navbars.admin_navbar')
    <div class="card">
        <div class="card-header">
            <h5>Edit Status Pendaftaran: {{ $peserta->peserta_name }}</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('partisipan.update', $data->pendaftaran_id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Status Pendaftaran</label>
                    <select name="status_id" class="form-select">
                        @foreach ($status as $s)
                            <option value="{{ $s->status_id }}" {{ $data->status_id == $s->status_id ? 'selected' : '' }}>
                                {{ $s->status_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Catatan Admin</label>
                    <textarea name="pendaftaran_catatan" class="form-control" rows="4"
                        placeholder="Contoh: Berkas kurang lengkap atau alasan ditolak">{{ $data->pendaftaran_catatan }}</textarea>
                </div>

                <div class="text-end">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
