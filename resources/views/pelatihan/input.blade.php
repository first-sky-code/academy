@extends('backend.admintemplate')
@section('title', 'Input Pelatihan')
@section('content')
    @include('navbars.admin_navbar')
    <h1 class="text-center">{{ $data['id'] == 0 ? 'Input Pelatihan' : 'Edit Pelatihan' }}</h1>
    <div class="row g-3" style="background: white; padding:20px; border-radius:10px; margin-top:20px;">
        <form class="needs-validation" action="{{ route('pelatihan.store') }}" method="POST"
            style="background: white; padding:20px; border-radius:10px; margin-top:20px;" enctype="multipart/form-data"
            novalidate>
            @csrf
            <input type="hidden" name="type" value="pelatihan.pelatihan">
            <input type="hidden" name="id" value="{{ $data['id'] }}">

            <div class="row">
                <div class="col-xl-6">
                    <label>Nama Pelatihan</label>
                    <input type="text" class="form-control @error('pelatihan_name') is-invalid @enderror"
                        id="pelatihan_name" name="pelatihan_name" placeholder="Masukkan nama pelatihan"
                        value="{{ $data['id'] == 0 ? '' : $data['ketemu']->pelatihan_name }}" required>
                    <div class="invalid-feedback">Nama pelatihan harus diisi</div>
                </div>
                <div class="col-xl-6">
                    <label>Kategori Pelatihan</label>
                    <select class="form-select mb-3 @error('kategori_pelatihan_id') is-invalid @enderror"
                        aria-label="Default select example" name="kategori_pelatihan_id" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($data['kategori'] as $item)
                            <option value="{{ $item->kategori_pelatihan_id }}"
                                {{ $data['id'] != 0 && $data['ketemu']->kategori_pelatihan_id == $item->kategori_pelatihan_id ? 'selected' : '' }}>
                                {{ $item->kategori_pelatihan_name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Kategori pelatihan harus diisi</div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6">
                    <label for="silabus" class="form-label">Silabus</label>
                    <input class="form-control" type="file" id="silabus" name="silabus">
                    @if ($data['id'] != 0 && !empty($data['ketemu']->pelatihan_silabus))
                        <small class="text-muted">File saat ini: {{ $data['ketemu']->pelatihan_silabus }}</small>
                    @endif
                </div>
                <div class="col-xl-6">
                    <label>Jadwal Pelatihan</label>
                    <input type="text" class="form-control @error('pelatihan_jadwal') is-invalid @enderror"
                        id="pelatihan_jadwal" name="pelatihan_jadwal" placeholder="Masukkan jadwal pelatihan"
                        value="{{ $data['id'] == 0 ? '' : $data['ketemu']->pelatihan_jadwal }}" required>
                    <div class="invalid-feedback">Jadwal pelatihan harus diisi</div>
                </div>
            </div>

            <div class="row" style="margin-top: 15px">
                <div class="col-xl-6">
                    <label for="pelatihan_mulai" class="form-label">Tanggal Mulai Pendaftaran</label>
                    <input type="date" class="form-control" id="pelatihan_mulai" name="pelatihan_mulai"
                        value="{{ $data['ketemu']->pelatihan_mulai ?? '' }}" required>
                    <div class="invalid-feedback">Tanggal mulai pendaftaran harus diisi</div>
                </div>
                <div class="col-xl-6">
                    <label for="pelatihan_tutup" class="form-label">Tanggal Tutup Pendaftaran</label>
                    <input type="date" class="form-control" id="pelatihan_tutup" name="pelatihan_tutup"
                        value="{{ $data['ketemu']->pelatihan_tutup ?? '' }}" required>
                    <div class="invalid-feedback">Tanggal tutup pendaftaran harus diisi</div>
                </div>
            </div>

            <div class="col-xl-12" style="margin-top: 15px">
                <label class="form-label">Syarat Pelatihan (Pilih Satu Persatu)</label>
                <div id="dynamic-syarat-container">
                </div>
            </div>

            <div style="margin-top: 15px">
                <label for="pelatihan_tatacara" class="form-label">Tata Cara Pendaftaran</label>
                <textarea class="form-control" id="pelatihan_tatacara" name="pelatihan_tatacara" rows="3">{{ $data['ketemu']->pelatihan_tatacara ?? '' }}</textarea>
                <div class="invalid-feedback">Tata cara pendaftaran harus diisi</div>
            </div>

            <button type="submit" class="btn rounded-pill btn-outline-primary waves-effect waves-light"
                style="margin-top: 15px"><i
                    class="ri-add-line label-icon align-middle rounded-pill fs-12 me-1"></i>Simpan</button>
        </form>
    </div>

    <script>
        const syaratData = @json($data['syarat'] ?? []);
        const syaratTerpilih = @json($data['syarat_terpilih'] ?? []); // Data dari Controller
        const syaratContainer = document.getElementById('dynamic-syarat-container');

        function createDynamicRow(container, dataList, nameAttr, isFirst = false, selectedValue = "", type = "Syarat") {
            const row = document.createElement('div');
            row.className = `row mb-2 ${type.toLowerCase()}-row animate__animated animate__fadeIn`;

            const placeholder = isFirst ? `Pilih ${type}` : `-- Pilih ${type} Tambahan --`;
            let options = `<option value="">${placeholder}</option>`;

            dataList.forEach(item => {
                const id = item[`${type.toLowerCase()}_id`];
                const name = item[`${type.toLowerCase()}_name`];
                // Perbaikan: gunakan == agar id integer dan string bisa cocok
                const selected = id == selectedValue ? 'selected' : '';
                options += `<option value="${id}" ${selected}>${name}</option>`;
            });

            row.innerHTML = `
                <div class="col-xl-10">
                    <select class="form-select select-${type.toLowerCase()}-dinamis" name="${nameAttr}[]" ${isFirst ? 'required' : ''}>
                        ${options}
                    </select>
                </div>
                <div class="col-xl-2">
                    <button type="button" class="btn btn-outline-danger w-100 btn-hapus-${type.toLowerCase()}" style="${isFirst ? 'display:none;' : ''}">
                        <i class="ri-delete-bin-line"></i>
                    </button>
                </div>
            `;

            container.appendChild(row);
            updateOptions(`.select-${type.toLowerCase()}-dinamis`);
            return row;
        }

        function updateOptions(selector) {
            const allSelects = document.querySelectorAll(selector);
            const selectedValues = Array.from(allSelects).map(s => s.value).filter(v => v !== "");

            allSelects.forEach(select => {
                select.querySelectorAll('option').forEach(option => {
                    if (option.value !== "") {
                        const isAlreadySelected = selectedValues.includes(option.value);
                        const isCurrentSelection = select.value === option.value;
                        option.disabled = isAlreadySelected && !isCurrentSelection;
                        option.style.color = option.disabled ? "#ccc" : "";
                    }
                });
            });
        }

        // --- LOGIKA PEMANGGILAN DATA SAAT LOAD ---
        if (syaratContainer) {
            if (syaratTerpilih.length > 0) {
                // Jika ada data (Mode Edit), buat baris untuk setiap syarat terpilih
                syaratTerpilih.forEach((val, index) => {
                    createDynamicRow(syaratContainer, syaratData, 'syarat_id', (index === 0), val, "Syarat");
                });
                // Tambahkan satu baris kosong di bawah agar admin bisa nambah lagi
                createDynamicRow(syaratContainer, syaratData, 'syarat_id', false, "", "Syarat");
            } else {
                // Jika data kosong (Mode Input Baru)
                createDynamicRow(syaratContainer, syaratData, 'syarat_id', true, "", "Syarat");
            }
        }

        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('select-syarat-dinamis')) {
                updateOptions('.select-syarat-dinamis');
                const rows = document.querySelectorAll('.syarat-row');
                // Tambah baris baru jika baris terakhir sudah diisi
                if (e.target === rows[rows.length - 1].querySelector('select') && e.target.value !== "") {
                    createDynamicRow(syaratContainer, syaratData, 'syarat_id', false, "", "Syarat");
                }
            }
        });

        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-hapus-syarat')) {
                e.target.closest('.syarat-row').remove();
                updateOptions('.select-syarat-dinamis');
            }
        });

        $('#pelatihan_tatacara').summernote({
            placeholder: 'Masukkan tata cara pendaftaran pelatihan',
            tabsize: 2,
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    </script>
@endsection
