@extends('backend.admintemplate')
@section('title', 'Hapus Part Penting')
@section('content')
    @include('navbars.admin_navbar')
    <div class="row">
        <form action="{{ route('admins.delete', ['type' => $type, 'id' => $id]) }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="card-body text-center" style="background: white; padding:20px; border-radius:10px; margin:60px;">

                <h1>
                    Apakah anda yakin ingin menghapus
                    @switch($type)
                        @case('kategori')
                            Kategori
                        @break

                        @case('mentor')
                            Mentor
                        @break

                        @case('syarat')
                            Syarat
                        @break

                        @case('status')
                            Status
                        @break

                        @default
                            data
                        @break
                    @endswitch
                    ini?
                </h1>

                <button type="submit" class="btn rounded-pill btn-lg btn-outline-danger waves-effect waves-light">
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
@endsection
