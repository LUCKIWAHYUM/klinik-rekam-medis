<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <title>Nota Pembayaran</title>

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
        @foreach ($kunjungan as $data)
        <h2>KLINIK PRATAMA AISYIYAH AMBULU</h2>
        <p>JL.Hasanudin Gg.III No.94 Telp.085234199394</p>
        <p>AMBULU - JEMBER</p>
        <p>===============================================================================================</p>
    </div>
    <div class="content">
        <div class="info">
            <div class="header">
                <h2 class="text-align-center">Bukti Pembayaran</h2>
            </div>
            <table>
                <tr>
                    <th>Nama Lengkap</th>
                    <td>: {{ $data->nama_pasien }}</td>
                    <th></th>
                    <td></td>
                    <th></th>
                    <td></td>
                    <th></th>
                    <td></td>
                    <th></th>
                    <td></td>
                    <th></th>
                    <td></td>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                    <th>Nama Dokter</th>
                    <td>: {{ $data->nama_dokter }}</td>
                </tr>
                <tr>
                    <th>NO Periksa</th>
                    <td>: {{ $data->no_periksa }}</td>
                </tr>
                <tr>
                    <th>Biaya</th>
                    <td>: {{ $data->askes }}</td>
                </tr>
                <tr>
                    <th>NO Dana Sehat</th>
                    <td>: {{ $data->no_dana_sehat }}</td>
                </tr>
                <tr>

                    <td>Untuk Pembayaran</td>
                </tr>
                <tr>
                    <td></td>
                    <th>Biaya Tindakan</th>
                    <td>: Rp. {{ number_format($data->hargatindakan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td></td>
                    <th>Biaya obat</th>
                   <td style="border-bottom: 1px solid black;">: Rp. {{ number_format($totalobat, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Total Pembayaran</th>
                    <td></td>
                    <td>Rp. {{ number_format($totalobat + $data->hargatindakan, 0, ',', '.') }}</td>
                </tr>
            </table>
             @endforeach
            <!-- <p>===============================================================================================</p> -->
        </div>
    </div><br><br><br>
    <div class="signature">
        @foreach ($kunjungan as $data)
        Ambulu, {{ \Carbon\Carbon::parse($data->tgl_kunjungan)->translatedFormat('d F Y') }} <br>
        @endforeach
        Tanda tangan,<br><br><br>
        Administrasi
    </div>
</body>
</html>
<script>
    // Mencetak surat secara otomatis saat halaman dimuat
    window.onload = function() {
        window.print();
    };
</script>
