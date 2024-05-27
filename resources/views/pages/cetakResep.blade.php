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
            max-width: 800px;
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
        .header {
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
            padding: 8px;
        }

    </style>
</head>
<body>
     <div class="invoice-container" id="invoice-content">
        <div class="header">
            @foreach ($resep as $data)
            <h2>KLINIK PRATAMA AISYIYAH AMBULU</h2>
            <p>JL.Hasanudin Gg.III No.94 Telp.085234199394</p>
            <p>AMBULU - JEMBER</p>
            <p>===================================================================</p>
        </div>
        <div class="invoice-details">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width: 30%; font-weight: bold;">No Periksa</td>
                        <td>{{ $data->no_periksa }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Nama Pasien</td>
                        <td>{{ $data->nama_pasien }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endforeach
        <div class="invoice-items">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Obat</th>
                        <th scope="col">Aturan Pakai</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Satuan</th>
                        <th scope="col">Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($resep as $data)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $data->nama_obat }}</td>
                        <td>{{ $data->aturanpakai }}</td>
                        <td>{{ $data->jumlah }}</td>
                        <td>{{ $data->satuan }}</td>
                        <td>{{ $data->deskripsi }}</td>
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
