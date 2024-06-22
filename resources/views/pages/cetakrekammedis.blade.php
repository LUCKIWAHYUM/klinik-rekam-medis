<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <title>Lembar Pemeriksaan Rawat Jalan</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            /* border: 1px solid #ccc; */
            /* border-radius: 8px; */
            background-color: #fff;
            position: relative; /* Menggunakan posisi relatif untuk elemen body */
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            margin-bottom: 30px;
            padding-bottom: 20px;
            /* border-bottom: 1px solid #ccc; */
        }
        .info {
            margin-bottom: 15px;
        }
        .info table {
            width: 100%;
        }
        .info table th,
        .info table td {
            padding: 8px;
            /* border-bottom: 1px solid #ddd; */
            text-align: left; /* Tekst rata kiri untuk semua th dan td */
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
        .signature {
            position: absolute;
            bottom: 20px;
            right: 20px;
            font-style: italic;
            font-size: 12px;
        }
        .footer-text {
            font-size: 12px;
        }
        .footer-text span {
            display: block;
            margin-top: 20px;
        }
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>KLINIK PRATAMA AISYIYAH AMBULU</h2>
        <p>JL.Hasanudin Gg.III No.94 Telp.085234199394</p>
        <p>AMBULU - JEMBER</p>
        <p>===============================================================================================</p>
    </div>
    <div class="header">
        <h2>Lembar Pemeriksaan Rawat Jalan</h2>
    </div>
    <div class="content">
        <div class="info">
            <table>
                <tr>
                    <th>No. RM</th>
                    <td>{{ $pasien->no_rmd }}</td>
                    <th>Agama</th>
                    <td>{{ $pasien->agama }}</td>
                </tr>
                <tr>
                    <th>Nama Lengkap</th>
                    <td>{{ $pasien->nama_pasien }}</td>
                    <th>TTL</th>
                    <td>{{ $pasien->tempat_lahir }},{{ $pasien->tgl_lahir }}</td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td>{{ $pasien->nik }}</td>
                    <th>Jenis Kelamin</th>
                    <td>{{ $pasien->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <th>Pekerjaan</th>
                    <td>{{ $pasien->pekerjaan }}</td>
                    <th>Biaya</th>
                    <td>{{ $pasien->askes }}</td>
                </tr>
                <tr>
                    <th>No. HP</th>
                    <td>{{ $pasien->no_telp }}</td>
                    <th>No. Dana Sehat</th>
                    <td>{{ $pasien->no_dana_sehat }}</td>
                </tr>
            </table>
            @foreach ($kunjungan as $data)
            <p>===============================================================================================</p>
            <table class="table table-bordered">
                <tr>
                    <th>Alergi</th>
                    <td>{{ $data->alergi }}</td>
                </tr>
                <tr>
                    <th>(S) subjective</th>
                    <td>{{ $data->keluhan }}</td>
                </tr>
                <tr>
                    <th>(O) objective</th>
                    <td>
                        <div>
                            <span style="display: inline-block; width: 150px;">: Tinggi Badan&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="display: inline-block; width: 15px; text-align: center;">:</span>&nbsp;{{ $data->tb }}<br>
                            <span style="display: inline-block; width: 150px;">: Berat Badan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="display: inline-block; width: 15px; text-align: center;">:</span>&nbsp;{{ $data->bb }}<br>
                            <span style="display: inline-block; width: 150px;">: Tekanan Darah&nbsp;</span><span style="display: inline-block; width: 15px; text-align: center;">:</span>&nbsp;{{ $data->td }}<br>
                            <span style="display: inline-block; width: 150px;">: Denyut Nadi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="display: inline-block; width: 15px; text-align: center;">:</span>&nbsp;{{ $data->nadi }}<br>
                            <span style="display: inline-block; width: 150px;">: Suhu Tubuh&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="display: inline-block; width: 15px; text-align: center;">:</span>&nbsp;{{ $data->suhutubuh }}<br>
                            <span style="display: inline-block; width: 150px;">: SPO2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="display: inline-block; width: 15px; text-align: center;">:</span>&nbsp;{{ $data->spo2 }}<br>
                            <span style="display: inline-block; width: 150px;">: Pernapasan/RR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="display: inline-block; width: 15px; text-align: center;">:</span>&nbsp;{{ $data->pernapasan }}<br>
                            <span style="display: inline-block; width: 150px;">: Pemeriksaan Lain&nbsp;&nbsp;</span><span style="display: inline-block; width: 15px; text-align: center;">:</span>&nbsp;{{ $data->periksalain }}<br>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>(A) assessment</th>
                    <td>{{ $data->diagnosa }}</td>
                </tr>
                <tr>
                    <th>(P) planning</th>
                    <td>@foreach (json_decode($data->tindakan, true) as $nama_tindakan)
                        <ul>
                            <li>{{ $nama_tindakan }}</li>
                        </ul>
                        @endforeach</td>
                        @endforeach
                    </tr>
                    <tr>
                        <th>Resep Obat</th>
                        <td>
                            @foreach ($resep as $data)
                            {{ $data->nama_obat }},
                            @endforeach
                        </td>
                </tr>
                <tr>
                    <th>Aturan Pakai</th>
                    <td>
                        @foreach ($resep as $data)
                        {{ $data->aturanpakai }},
                    @endforeach
                    </td>
                </tr>
                <tr>
                    <th>Keterangan Dokter</th>
                    <td>
                        @foreach ($resep as $data)
                        {{ $data->deskripsi }}
                    @endforeach
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
<script>
    // Mencetak surat secara otomatis saat halaman dimuat
    // window.onload = function() {
    //     window.print();
    // };
</script>
