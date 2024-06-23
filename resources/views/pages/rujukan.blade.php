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

        table, th, td {
            border: 0px;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 2px 0px;
            /* border-bottom: 1px solid #ddd; */
            text-align: left; /* Tekst rata kiri untuk semua th dan td */
            vertical-align: top;
            border: none;
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
    <h2 style="text-align: center;">SURAT RUJUKAN</h2>
    <div class="content">
        <div class="info">
            <table>
                <tr>
                    <td>
                        Yth. TS / Dr. Jaga
                    </td>
                </tr>
                <tr>
                    <td>
                        RS {{$tujuan}}
                    </td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td>
                        Dengan Hormat.
                    </td>
                </tr>
                <tr>
                    <td>
                        Mohon pemeriksaan dan penanganan selanjutnya :
                    </td>
                </tr>
                <tr>
                    <td width="50%">
                        <table>
                            <tr>
                                <td width="30%">Nama</td>
                                <td width="70%">: {{$kunjungan->pasien->nama_pasien}}</td>
                            </tr>
                            <tr>
                                <td width="30%">Tanggal Lahir</td>
                                <td width="70%">: {{$kunjungan->pasien->tanggal_lahir}}</td>
                            </tr>
                            <tr>
                                <td width="30%">Alamat</td>
                                <td width="70%">: {{$kunjungan->pasien->alamat}}</td>
                            </tr>
                        </table>
                    </td>
                    <td width="50%">
                        <table>
                            <tr>
                                <td width="30%">Jenis Kelamin</td>
                                <td width="70%">: {{$kunjungan->pasien->jenis_kelamin}}</td>
                            </tr>
                            <tr>
                                <td width="30%">Umur</td>
                                <td width="70%">: {{$kunjungan->pasien->usia}}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        Pada pemeriksaan kami mendapatkan :
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table width="100%">
                            <tr>
                                <td width="15%">Anamnesa</td>
                                <td width="1%">:</td>
                                <td width="84%">{{$kunjungan->keluhan}}</td>
                            </tr>
                            <tr>
                                <td width="15%">Pemeriksaan Fisik</td>
                                <td width="1%">:</td>
                                <td width="84%">TB {{$kunjungan->tb}}, BB {{$kunjungan->bb}}, Tekanan Darah {{$kunjungan->td}}, Denyut Nadi {{$kunjungan->nadi}}, Suhu Tubuh {{$kunjungan->suhutubuh}}, SPO2 {{$kunjungan->spo2}}, Pernapasan/RR {{$kunjungan->pernapasan}}, Alergi {{$kunjungan->alergi}}</td>
                            </tr>
                            <tr>
                                <td width="15%">Diagnosa</td>
                                <td width="1%">:</td>
                                <td width="84%">{{$kunjungan->diagnosa}}</td>
                            </tr>
                            <tr>
                                <td width="100%" colspan="3">
                                    Obat dan Tindakan yang diberikan: Obat (
                                        @php
                                            $nama_obat_list = array_column(json_decode($kunjungan->resep, true), 'nama_obat');
                                            $nama_obat_str = implode(', ', $nama_obat_list);
                                        @endphp
                                        {{ $nama_obat_str }}
                                    )
                                </td>
                            </tr>
                            <tr>
                                <td width="100%" colspan="3">
                                    <ul>
                                        @foreach ($kunjungan->tindakan as $tindakan)
                                            <li>{{ $tindakan }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        Demikian atas bantuannya, diucapkan banyak terima kasih.
                    </td>
                </tr>
                <tr>
                    <td width="50%"></td>
                    <td width="50%">
                        <table>
                            <tr>
                                <td width="60%"></td>
                                <td width="40%">Ambulu, {{date('d F Y')}}</td>
                            </tr>
                            <tr>
                                <td width="60%"></td>
                                <td width="40%">Hormat Kami</td>
                            </tr>
                            <tr>
                                <td width="60%"></td>
                                <td width="40%"><br><br></td>
                            </tr>
                            <tr>
                                <td width="60%"></td>
                                <td width="40%">{{Auth::user()->name}}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
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
