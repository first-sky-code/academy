@extends('backend.admintemplate')
@section('content')
    @include('navbars.admin_navbar')
    <div class="container shadow rounded p-4 mt-4" style="background-color: white">
        <form class="needs-validation" action="{{ route('admins.akun_store') }}" method="POST" novalidate
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $data['id'] }}">
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header align-item-center">
                            <h6 class="text-center">Name</h6>
                        </div>
                        <div class="card-body">
                            <input class="form-control @error('name') is-invalid @enderror" type="text"
                                placeholder="Name" id="name" name="name" value="{{ $data['ketemu']->name ?? '' }}"
                                required>
                            <div class="invalid-feedback">Name tidak boleh kosong</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header align-item-center">
                            <h6 class="text-center">Email</h6>
                        </div>
                        <div class="card-body">
                            <input class="form-control @error('email') is-invalid @enderror" type="email"
                                placeholder="Email Anda" id="email" name="email"
                                value="{{ $data['ketemu']->email ?? '' }}" required>
                            <div class="invalid-feedback">Email tidak boleh kosong</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header align-item-center">
                            <h6 class="text-center">Password</h6>
                        </div>
                        <div class="card-body">
                            <input class="form-control @error('password') is-invalid @enderror" type="password"
                                placeholder="Password" id="password" name="password"
                                value="{{ $data['ketemu']->password ?? '' }}" required>
                            <div class="invalid-feedback">Password tidak boleh kosong</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header align-item-center">
                            <h6 class="text-center">Usertype</h6>
                        </div>
                        <div class="card-body">
                            <input class="form-control @error('usertype') is-invalid @enderror" type="text"
                                placeholder="Usertype" id="usertype" name="usertype"
                                value="{{ $data['ketemu']->usertype ?? '' }}" required>
                            <div class="invalid-feedback">Usertype tidak boleh kosong</div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-end">
                <button type="submit" class="btn rounded-pill btn-outline-primary waves-effect waves-light"><i
                        class="ri-add-line label-icon align-middle rounded-pill fs-12 me-1"></i>Simpan</button>
            </p>
        </form>
    </div>
@endsection
