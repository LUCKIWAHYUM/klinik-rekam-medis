<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS kustom */
        body {
            font-size: 16px;
        }
        .invoice-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            visibility: hidden; /* Sembunyikan konten utama */
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-details {
            margin-bottom: 20px;
        }
        .invoice-details table {
            width: 100%;
        }
        .invoice-details table td {
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="invoice-container" id="invoice-content">
        <div class="invoice-header">
            <h2>Laporan Kunjungan</h2>
        </div>
        <div class="invoice-items">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Tanggal</th>
                        <th scope="col">No Registrasi</th>
                        <th scope="col">NO RM</th>
                        <th scope="col">NO Askes</th>
                        <th scope="col">Nama pasien</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Tgl Lahir</th>
                        <th scope="col">Umur</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Tindakan</th>
                        <th scope="col">Diagnosa</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($periksa as $data)
                    <tr>
                        <th>{{ $data->tgl_kunjungan }}</th>
                        <td>{{ $data->pasien->noregis }}</td>
                        <td>{{ $data->pasien->no_rmd }}</td>
                        <td>{{ $data->pasien->no_dana_sehat }}</td>
                        <td>{{ $data->pasien->nama_pasien }}</td>
                        <td>{{ $data->pasien->alamat }}</td>
                        <td>{{ $data->pasien->tanggal_lahir }}</td>
                        <td>{{ $data->pasien->usia }}</td>
                        <td>{{ $data->pasien->jenis_kelamin }}</td>
                        <td>@if ($data->tindakan)
                                            @foreach ($data->tindakan as $nama_tindakan)
                                                <ul>
                                                    <li>{{ $nama_tindakan }}</li>
                                                </ul>
                                            @endforeach
                                        @endif</td>
                        <td>{{ $data->diagnosa }}</td>
                        <td>{{ $data->pasien->statuspasien }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS dan jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mencetak struk secara otomatis saat halaman dimuat
        window.onload = function() {
            document.getElementById('invoice-content').style.visibility = 'visible'; // Tampilkan konten
            window.print();
        };
    </script>
</body>
</html>
