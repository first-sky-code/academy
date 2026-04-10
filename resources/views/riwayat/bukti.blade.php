<!DOCTYPE html>
<html>

<head>
    <title>Bukti Pendaftaran</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: sans-serif;
            padding: 30px;
        }

        .header {
            text-align: center;
            text-decoration: underline;
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 40px;
        }

        /* Tabel Utama - Mengunci posisi agar tidak berantakan */
        .layout-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            /* Mengunci lebar kolom */
        }

        .layout-table td {
            vertical-align: top;
        }

        /* Sisi Kiri: Biodata */
        .biodata-column {
            width: 75%;
        }

        /* Sisi Kanan: Foto */
        .photo-column {
            width: 25%;
            text-align: right;
        }

        /* Tabel Detail Biodata */
        .content-table {
            width: 100%;
            border-collapse: collapse;
        }

        .content-table td {
            padding: 8px 0;
            font-size: 14px;
            vertical-align: top;
        }

        .label {
            width: 160px;
            /* Lebar label tetap agar titik dua sejajar */
        }

        .separator {
            width: 20px;
            text-align: center;
        }

        /* --- STYLING FOTO LINGKARAN --- */
        .photo-container {
            width: 130px;
            height: 130px;
            display: inline-block;
        }

        .photo-circle {
            width: 125px;
            height: 150px;
            padding: 2px;
        }

        .footer {
            margin-top: 50px;
            font-size: 12px;
            font-style: italic;
            border-top: 0.5px solid #ccc;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        Bukti Pendaftaran Pelatihan
    </div>

    <table class="layout-table">
        <tr>
            <td class="biodata-column">
                <table class="content-table">
                    <tr>
                        <td class="label">Nama</td>
                        <td class="separator">:</td>
                        <td><strong>{{ $data->peserta_nama_lengkap ?? $data->peserta_name }}</strong></td>
                    </tr>
                    <tr>
                        <td class="label">Tempat / Tgl Lahir</td>
                        <td class="separator">:</td>
                        <td>
                            {{ $data->peserta_tempat_lahir ?? '-' }} /
                            {{ $data->peserta_tanggal_lahir ? \Carbon\Carbon::parse($data->peserta_tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="label">
                            @if (!empty($data->sekolah_name))
                                Asal Sekolah
                            @elseif(!empty($data->opd_name))
                                Asal OPD
                            @else
                                Asal Instansi
                            @endif
                        </td>
                        <td class="separator">:</td>
                        <td>
                            {{ $data->sekolah_name ?? ($data->opd_name ?? ($data->peserta_asal_instansi ?? '-')) }}
                        </td>
                    </tr>
                    <tr>
                        <td class="label">
                            @if (!empty($data->peserta_nip))
                                NIP Peserta
                            @elseif(!empty($data->peserta_nisn))
                                NISN Peserta
                            @else
                                NIP / NISN
                            @endif
                        </td>
                        <td class="separator">:</td>
                        <td>
                            {{-- Logika menampilkan mana yang tersedia --}}
                            @if (!empty($data->peserta_nip))
                                {{ $data->peserta_nip }}
                            @elseif(!empty($data->peserta_nisn))
                                {{ $data->peserta_nisn }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Pelatihan yang dipilih</td>
                        <td class="separator">:</td>
                        <td><strong>{{ $data->pelatihan_name }}</strong></td>
                    </tr>
                </table>
            </td>

            <td class="photo-column">
                @if ($pathFoto)
                    <img src="{{ $pathFoto }}" class="photo-circle" alt="Foto">
                @endif
            </td>
        </tr>
    </table>

    <div class="footer">
        * Bukti ini harap dibawa ketika daftar ulang pada hari pertama pelatihan
    </div>
</body>

</html>
