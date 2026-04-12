@extends('backend.admintemplate')
@section('title', 'Hapus Pelatihan')
@section('content')
    @include('navbars.admin_navbar')
    <div class="row">
        <form action="{{ route('pelatihan.delete') }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $id }}">
            <input type="hidden" name="type" value="pelatihan.hapus">

            <div class="card-body text-center" style="background: white; padding:20px; border-radius:10px; margin:60px;">
                <h1>Apakah anda yakin ingin menghapus Pelatihan ini?</h1>
                <p>* Dengan menghapus data ini, semua informasi terkait (Peserta, Materi, dll) akan hilang secara permanen.
                </p>

                <div class="form-check d-flex justify-content-center mb-4 mt-3">
                    <input class="form-check-input" type="checkbox" id="confirmDelete">
                    <label class="form-check-label ms-2" for="confirmDelete">
                        Saya sadar dan setuju untuk menghapus data ini secara permanen.
                    </label>
                </div>

                <button type="submit" id="deleteBtn"
                    class="btn rounded-pill btn-lg btn-outline-danger waves-effect waves-light" disabled>
                    <i class="ri-delete-bin-5-line label-icon align-middle rounded-pill fs-12 me-1"></i>
                    Hapus
                </button>

                <a href="{{ url()->previous() }}"
                    class="btn rounded-pill btn-lg btn-outline-secondary waves-effect waves-light ms-2">
                    Batal
                </a>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('confirmDelete').addEventListener('change', function() {
            const deleteBtn = document.getElementById('deleteBtn');
            deleteBtn.disabled = !this.checked;
        });
    </script>
@endsection
