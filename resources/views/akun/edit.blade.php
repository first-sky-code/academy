@extends('backend.usertemplate')
@section('title', 'Edit Akun Saya')
@section('content')
    @include('navbars.landing_navbar')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 shadow rounded p-5 bg-white">
                <h4 class="mb-4">Halaman Edit Akun</h4>
                <hr>

                <form class="needs-validation" action="{{ route('akun.update') }}" method="POST" novalidate
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data['peserta_id'] }}">

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-1 text-center p-0"> : </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('peserta_nama_lengkap') is-invalid @enderror"
                                name="peserta_nama_lengkap" value="{{ $data['ketemu']->peserta_nama_lengkap ?? '' }}"
                                required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Jenis Identitas</label>
                        <div class="col-sm-1 text-center p-0"> : </div>
                        <div class="col-sm-8">
                            <select class="form-select" id="tipe_kode" onchange="toggleKode()">
                                <option value="">-- Pilih Jenis --</option>
                                <option value="nisn" {{ $data['ketemu']->peserta_nisn ? 'selected' : '' }}>NISN (Siswa)
                                </option>
                                <option value="nip" {{ $data['ketemu']->peserta_nip ? 'selected' : '' }}>NIP (Pegawai)
                                </option>
                            </select>
                        </div>
                    </div>

                    <div id="group_nisn" style="display: {{ $data['ketemu']->peserta_nisn ? 'flex' : 'none' }};"
                        class="row mb-3">
                        <label class="col-sm-3 col-form-label">NISN</label>
                        <div class="col-sm-1 text-center p-0"> : </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('peserta_nisn') is-invalid @enderror"
                                name="peserta_nisn" value="{{ $data['ketemu']->peserta_nisn ?? '' }}"
                                placeholder="10 digit NISN" maxlength="10">
                            @error('peserta_nisn')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div id="group_nip" style="display: {{ $data['ketemu']->peserta_nip ? 'flex' : 'none' }};"
                        class="row mb-3">
                        <label class="col-sm-3 col-form-label">NIP</label>
                        <div class="col-sm-1 text-center p-0"> : </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('peserta_nip') is-invalid @enderror"
                                name="peserta_nip" value="{{ $data['ketemu']->peserta_nip ?? '' }}"
                                placeholder="18 digit NIP" maxlength="18">
                            @error('peserta_nip')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Tipe Instansi</label>
                        <div class="col-sm-1 text-center p-0"> : </div>
                        <div class="col-sm-8">
                            <select class="form-select" id="tipe_instansi" onchange="toggleDropdown()">
                                <option value="">-- Pilih Tipe --</option>
                                <option value="sekolah" {{ $data['ketemu']->sekolah_id ? 'selected' : '' }}>Sekolah
                                </option>
                                <option value="opd" {{ $data['ketemu']->opd_id ? 'selected' : '' }}>OPD</option>
                            </select>
                        </div>
                    </div>

                    <div id="group_sekolah" style="display: {{ $data['ketemu']->sekolah_id ? 'flex' : 'none' }};"
                        class="row mb-3">
                        <label class="col-sm-3 col-form-label">Instansi Peserta</label>
                        <div class="col-sm-1 text-center p-0"> : </div>
                        <div class="col-sm-8">
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

                    <div id="group_opd" style="display: {{ $data['ketemu']->opd_id ? 'flex' : 'none' }};" class="row mb-3">
                        <label class="col-sm-3 col-form-label">Instansi Peserta</label>
                        <div class="col-sm-1 text-center p-0"> : </div>
                        <div class="col-sm-8">
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

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-1 text-center p-0"> : </div>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="peserta_alamat" rows="2">{{ $data['ketemu']->peserta_alamat ?? '' }}</textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Tempat Lahir</label>
                        <div class="col-sm-1 text-center p-0"> : </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="peserta_tempat_lahir"
                                value="{{ $data['ketemu']->peserta_tempat_lahir ?? '' }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-1 text-center p-0"> : </div>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" name="peserta_tanggal_lahir"
                                value="{{ $data['ketemu']->peserta_tanggal_lahir ?? '' }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Nomor HP</label>
                        <div class="col-sm-1 text-center p-0"> : </div>
                        <div class="col-sm-8">
                            <input type="tel" class="form-control" name="peserta_no_hp"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                value="{{ $data['ketemu']->peserta_no_hp ?? '' }}">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-sm-3 col-form-label">Foto Peserta</label>
                        <div class="col-sm-1 text-center p-0"> : </div>
                        <div class="col-sm-8">
                            <input type="file" class="form-control" name="peserta_foto">
                            <small class="text-muted">Format: jpg, jpeg, png. Maks 500KB.</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 text-end">
                            <button type="submit" class="btn btn-primary px-4">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            var tipe = document.getElementById('tipe_instansi').value;
            var groupSekolah = document.getElementById('group_sekolah');
            var groupOpd = document.getElementById('group_opd');

            groupSekolah.style.setProperty('display', 'none', 'important');
            groupOpd.style.setProperty('display', 'none', 'important');

            if (tipe === 'sekolah') {
                groupSekolah.style.setProperty('display', 'flex', 'important');
            } else if (tipe === 'opd') {
                groupOpd.style.setProperty('display', 'flex', 'important');
            }
        }

        function toggleKode() {
            var tipeKode = document.getElementById('tipe_kode').value;
            var groupNisn = document.getElementById('group_nisn');
            var groupNip = document.getElementById('group_nip');

            // Sembunyikan semua dan kosongkan input jika tidak dipilih agar tidak bentrok saat simpan
            groupNisn.style.setProperty('display', 'none', 'important');
            groupNip.style.setProperty('display', 'none', 'important');

            if (tipeKode === 'nisn') {
                groupNisn.style.setProperty('display', 'flex', 'important');
            } else if (tipeKode === 'nip') {
                groupNip.style.setProperty('display', 'flex', 'important');
            }
        }
    </script>
@endsection
