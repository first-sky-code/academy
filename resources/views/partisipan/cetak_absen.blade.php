<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        /* Tambahkan table-layout fixed */
        th,
        td {
            border: 1px solid black;
            padding: 6px;
            font-size: 10px;
            word-wrap: break-word;
        }

        /* Perkecil font sedikit */
        th {
            background-color: #d9e2f3;
            text-align: center;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <h3 style="text-decoration: underline;">Daftar Peserta Pelatihan ({{ $pelatihan->pelatihan_name }})</h3>
    </div>

    <table>
        <thead>
            <tr>
                <th width="8%">No.</th>
                <th width="30%">Nama</th>
                <th width="22%">Asal</th>
                <th width="25%">Alamat</th>
                <th width="15%">TTD</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pendaftar as $key => $p)
                <tr>
                    <td class="text-center">{{ $key + 1 }}.</td>
                    <td>
                        <strong>{{ $p->peserta_nama_lengkap }}</strong><br>
                        {{ $p->peserta_nisn ?? $p->peserta_nip }}
                    </td>
                    <td>{{ $p->sekolah_name ?? ($p->opd_name ?? '-') }}</td>
                    <td>{{ $p->peserta_alamat ?? '-' }}</td>
                    <td style="height: 40px;"></td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada peserta yang diterima.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
