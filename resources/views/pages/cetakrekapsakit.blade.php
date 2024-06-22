<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Kesakitan</title>
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
            <h2>Rekapitulasi Kesakitan</h2>
        </div>
        <div class="invoice-items">
            <div class="table-responsive mt-3">
                <table id="UserData" class="table table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center">No</th>
                            <th rowspan="2" class="text-center">Diagnosa</th>
                            <th colspan="2" class="text-center">Jenis Kelamin</th>
                            <th colspan="9" class="text-center" width="900px">Umur</th>
                            <th rowspan="2" class="text-center">Jumlah</th>
                        </tr>
                        <tr>
                            <th class="text-center">Laki-Laki</th>
                            <th class="text-center">Perempuan</th>
                            
                            <th class="text-center">0-5</th>
                            <th class="text-center">6-11</th>
                            <th class="text-center">12-16</th>
                            <th class="text-center">17-25</th>
                            <th class="text-center">26-35</th>
                            <th class="text-center">36-45</th>
                            <th class="text-center">46-55</th>
                            <th class="text-center">56-65</th>
                            <th class="text-center">>65</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach($periksa as $data)
                        <tr>
                            <td> {{$no++}} </td>
                            <!-- <td>{{ $data->kode }}</td> -->
                            <td>{{ $data->diagnosa }}</td>

                            <!-- Jenis Kelamin -->
                            <td>{{ $data->pria }}</td>
                            <td>{{ $data->wanita }}</td>

                            <!-- Umur -->
                            <td>{{ $data->balita }}</td>
                            <td>{{ $data->anak }}</td>
                            <td>{{ $data->remaja_awal }}</td>
                            <td>{{ $data->remaja_akhir }}</td>
                            <td>{{ $data->dewasa_awal }}</td>
                            <td>{{ $data->dewasa_akhir }}</td>
                            <td>{{ $data->lansia_awal }}</td>
                            <td>{{ $data->lansia_akhir }}</td>
                            <td>{{ $data->manula }}</td>

                            <!-- TOTAL -->
                            <td>{{ $data->total }}</td>
                            </tr>
                            

                        @endforeach

                        {{-- modal --}}


                    </tbody>
                </table>
            </div>        
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
