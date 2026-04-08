@extends('backend.usertemplate')
@section('content')
    @include('navbars.landing_navbar')
    <div class="container">
        <h4>Halaman Edit Akun</h4>
    </div>
    <div class="container shadow rounded p-4 mt-4">
        <form class="needs-validation" action="{{ route('akun.update') }}" method="POST" novalidate
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $data['peserta_id'] }}">
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header align-item-center">
                            <h6 class="text-center">Nama Lengkap</h6>
                        </div>
                        <div class="card-body">
                            <input class="form-control @error('peserta_nama_lengkap') is-invalid @enderror" type="text"
                                placeholder="Nama Lengkap Anda" id="peserta_nama_lengkap" name="peserta_nama_lengkap"
                                value="{{ $data['ketemu']->peserta_nama_lengkap ?? '' }}" required>
                            <div class="invalid-feedback">Nama Lengkap tidak boleh kosong</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header align-item-center">
                            <h6 class="text-center">Asal Instansi</h6>
                        </div>
                        <div class="card-body">
                            <input class="form-control @error('peserta_asal_instansi') is-invalid @enderror" type="text"
                                placeholder="Asal Instansi Anda" id="peserta_asal_instansi" name="peserta_asal_instansi"
                                value="{{ $data['ketemu']->peserta_asal_instansi ?? '' }}" required>
                            <div class="invalid-feedback">Asal Instansi tidak boleh kosong</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header align-item-center">
                    <h6 class="text-center">Alamat</h6>
                </div>
                <div class="card-body">
                    <textarea class="form-control @error('peserta_alamat') is-invalid @enderror" type="text"
                        placeholder="Alamat lengkap Anda" id="peserta_alamat" name="peserta_alamat" required>{{ $data['ketemu']->peserta_alamat ?? '' }}</textarea>
                    <div class="invalid-feedback">Alamat tidak boleh kosong</div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header align-item-center">
                            <h6 class="text-center">Nomor HP</h6>
                        </div>
                        <div class="card-body">
                            <input class="form-control @error('peserta_no_hp') is-invalid @enderror" type="tel"
                                inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                placeholder="Nomor HP Anda" id="peserta_no_hp" name="peserta_no_hp"
                                value="{{ $data['ketemu']->peserta_no_hp ?? '' }}" required>
                            <div class="invalid-feedback">Nomor HP tidak boleh kosong</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header align-item-center">
                            <h6 class="text-center">Foto</h6>
                        </div>
                        <div class="card-body">
                            <input class="form-control @error('peserta_foto') is-invalid @enderror" type="file"
                                accept=".jpg, .jpeg, .png" name="peserta_foto"
                                value="{{ $data['ketemu']->peserta_foto ?? '' }}" required> <small
                                class="text-muted">Format: jpg, jpeg, png. Maksimal
                                500KB.</small>
                            @error('peserta_foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="invalid-feedback">Foto tidak boleh kosong</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="text-center">NISN / NIP Peserta</h6>
                        </div>
                        <div class="card-body">
                            <input class="form-control" type="text" name="peserta_unique_code"
                                value="{{ $data['ketemu']->peserta_unique_code ?? '' }}" placeholder="Masukkan kode unik">
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="text-center">Tanggal Lahir</h6>
                        </div>
                        <div class="card-body">
                            <input class="form-control" type="date" name="peserta_tanggal_lahir"
                                value="{{ $data['ketemu']->peserta_tanggal_lahir ?? '' }}" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="text-center">Tipe Instansi</h6>
                        </div>
                        <div class="card-body">
                            <select class="form-select" id="tipe_instansi" onchange="toggleDropdown()">
                                <option value="">-- Pilih Tipe --</option>
                                <option value="sekolah" {{ $data['ketemu']->sekolah_id ? 'selected' : '' }}>Sekolah
                                </option>
                                <option value="opd" {{ $data['ketemu']->opd_id ? 'selected' : '' }}>OPD</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8" id="group_sekolah"
                    style="display: {{ $data['ketemu']->sekolah_id ? 'block' : 'none' }};">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="text-center">Pilih Sekolah</h6>
                        </div>
                        <div class="card-body">
                            <select class="form-select" name="sekolah_id">
                                <option value="">-- Pilih Sekolah --</option>
                                @foreach ($sekolah as $s)
                                    <option value="{{ $s->sekolah_id }}"
                                        {{ $data['ketemu']->sekolah_id == $s->sekolah_id ? 'selected' : '' }}>
                                        {{ $s->sekolah_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8" id="group_opd" style="display: {{ $data['ketemu']->opd_id ? 'block' : 'none' }};">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="text-center">Pilih OPD</h6>
                        </div>
                        <div class="card-body">
                            <select class="form-select" name="opd_id">
                                <option value="">-- Pilih OPD --</option>
                                @foreach ($opd as $o)
                                    <option value="{{ $o->opd_id }}"
                                        {{ $data['ketemu']->opd_id == $o->opd_id ? 'selected' : '' }}>
                                        {{ $o->opd_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-end">
                <button type="submit" class="btn btn-outline-primary">Simpan</button>
            </p>
        </form>
    </div>

    <script>
        function toggleDropdown() {
            var tipe = document.getElementById('tipe_instansi').value;
            var groupSekolah = document.getElementById('group_sekolah');
            var groupOpd = document.getElementById('group_opd');

            // Reset display
            groupSekolah.style.display = 'none';
            groupOpd.style.display = 'none';

            // Reset value select agar tidak terkirim dua-duanya
            groupSekolah.querySelector('select').value = "";
            groupOpd.querySelector('select').value = "";

            if (tipe === 'sekolah') {
                groupSekolah.style.display = 'block';
            } else if (tipe === 'opd') {
                groupOpd.style.display = 'block';
            }
        }
    </script>
@endsection
