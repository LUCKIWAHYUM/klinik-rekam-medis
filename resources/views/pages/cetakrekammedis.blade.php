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
            vertical-align: top;
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
        <p>==================================================================================================</p>
    </div>
    <h2 style="text-align: center;">Lembar Pemeriksaan Rawat Jalan</h2>
    <div class="content">
        <div class="info">
            <table style="border-bottom: 1px solid black;">
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
                    <td>{{ $pasien->tempat_lahir }},{{ $pasien->tanggal_lahir }}</td>
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

            <table class="table table-bordered" style="margin-top: 10px">
                <thead class="text-center">
                    <tr>
                        <th style="text-align:center !important;" width="10%">Tanggal</th>
                        <th style="text-align:center !important;" width="40%">SOAP</th>
                        <th style="text-align:center !important;" width="20%">Terapi</th>
                        <th style="text-align:center !important;" width="20%">Tindakan/KIE</th>
                        <th style="text-align:center !important;" width="10%">Paraf</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kunjunganpasien as $datakunjungan)
                        <tr>
                            <td>{{$datakunjungan->tgl_kunjungan}}</td>
                            <td>
                                <h4>
                                    <b>(S) subjective:</b>
                                </h4>
                                <div class="mb-4">
                                    <span>{{$datakunjungan->keluhan}}</span>
                                </div>
                                <h4>
                                    <b>(O) objective:</b>
                                </h4>
                                <div class="mb-4">
                                    <span style="display: inline-block; width: 150px;">Tinggi Badan&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="display: inline-block; width: 15px; text-align: center;">:</span>&nbsp;{{ $datakunjungan->tb }}<br>
                                    <span style="display: inline-block; width: 150px;">Berat Badan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="display: inline-block; width: 15px; text-align: center;">:</span>&nbsp;{{ $datakunjungan->bb }}<br>
                                    <span style="display: inline-block; width: 150px;">Tekanan Darah&nbsp;</span><span style="display: inline-block; width: 15px; text-align: center;">:</span>&nbsp;{{ $datakunjungan->td }}<br>
                                    <span style="display: inline-block; width: 150px;">Denyut Nadi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="display: inline-block; width: 15px; text-align: center;">:</span>&nbsp;{{ $datakunjungan->nadi }}<br>
                                    <span style="display: inline-block; width: 150px;">Suhu Tubuh&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="display: inline-block; width: 15px; text-align: center;">:</span>&nbsp;{{ $datakunjungan->suhutubuh }}<br>
                                    <span style="display: inline-block; width: 150px;">SPO2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="display: inline-block; width: 15px; text-align: center;">:</span>&nbsp;{{ $datakunjungan->spo2 }}<br>
                                    <span style="display: inline-block; width: 150px;">Pernapasan/RR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="display: inline-block; width: 15px; text-align: center;">:</span>&nbsp;{{ $datakunjungan->pernapasan }}<br>
                                    <span style="display: inline-block; width: 150px;">Pemeriksaan Lain&nbsp;&nbsp;</span><span style="display: inline-block; width: 15px; text-align: center;">:</span>&nbsp;{{ $datakunjungan->periksalain }}<br>
                                    <span style="display: inline-block; width: 150px;">Alergi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="display: inline-block; width: 15px; text-align: center;">:</span>&nbsp;{{ $datakunjungan->alergi }}<br>
                                </div>
                                <h4>
                                    <b>(A) assessment:</b>
                                </h4>
                                <div class="mb-4">
                                    <span>{{$datakunjungan->diagnosa}}</span>
                                </div>
                                <h4>
                                    <b>(P) planning:</b>
                                </h4>
                                <div class="mb-4">
                                    <ul>
                                        @foreach ($datakunjungan->tindakan as $tindakan)
                                            <li>{{ $tindakan }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </td>
                            <td>
                                @if (!empty($datakunjungan->resep))
                                    <ul>
                                        @foreach (json_decode($datakunjungan->resep, true) as $dataresep)
                                            <li>{{ $dataresep['nama_obat'] }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    ~
                                @endif
                            </td>
                            <td>
                                @if (!empty($datakunjungan->resep))
                                    <ul>
                                        @foreach (json_decode($datakunjungan->resep, true) as $dataresep)
                                            <li>{{ $dataresep['aturanpakai']." ".$dataresep['deskripsi'] }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    ~
                                @endif
                            </td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</body>
</html>
<script>
    // Mencetak surat secara otomatis saat halaman dimuat
    window.onload = function() {
        window.print();
    };
</script>
