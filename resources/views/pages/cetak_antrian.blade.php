<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Antrian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 26px; /* Ukuran teks untuk judul */
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px; /* Jarak antara sel dan teks */
            text-align: center;
            font-size: 24px; /* Ukuran teks untuk sel */
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            .container {
                max-width: 100%; /* Mengisi seluruh lebar kertas saat mencetak */
                margin: 0;
                padding: 0;
                border: none;
                border-radius: 0;
                box-shadow: none;
                display: flex;
                flex-direction: column;
                justify-content: center; /* Menengahkan secara vertikal */
                align-items: center; /* Menengahkan secara horizontal */
                height: 100vh; /* Menggunakan tinggi layar penuh */
    
            }
            

            table {
                width: 100%;
            }
            th, td {
                border: none;
                padding: 6px;
                text-align: center;
                font-size: 100px; /* Ukuran teks untuk sel saat mencetak */
            }
            th {
                background-color: #f2f2f2;
            }
            tr:nth-child(even) {
                background-color: #f2f2f2;
            }
            tr:hover {
                background-color: #ddd;
            }
            .large-number {
                font-size: 150px; /* Ukuran teks untuk nomor antrian */
                font-weight: bold; /* Tambahkan gaya bold untuk angka nomor antrian */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- <h1>Daftar Antrian Hari Ini</h1> -->
        <table>
            <thead>
                <tr>
                    <th>No Antrian</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kunjungan as $antrian)
                <tr>
                    <td class="large-number">{{ $antrian->no_antrian }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>
