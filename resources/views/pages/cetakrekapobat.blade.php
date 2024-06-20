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
            <h2>Rekapitulasi Obat</h2>
        </div>
        <div class="invoice-items">
        <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Obat</th>
                                        <th>Jumlah Obat</th>
                                        <th>Satuan</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach($Obat as $data)
                                    <tr>
                                        <td> {{$no++}} </td>
                                        <td> {{$data->nama_obat}} </td>
                                        <td> {{$data->totalobat}} </td>
                                        <td> {{$data->satuan}} </td>
                                     </tr>
                                     

                                    @endforeach

                                    {{-- modal --}}


                        </tbody>
                        <tfoot>
                        </tfoot>
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
