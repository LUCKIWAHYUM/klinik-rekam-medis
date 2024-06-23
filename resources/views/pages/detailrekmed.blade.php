@extends('layouts.dashboard')
@section('title','Detail Rekam Medis' )
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Rekam Medis</h1>
    </div>
    <div class="dashboard-content mb-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div>
                        
                        <a href="/cetak-rekmed/{{ $pasien->no_rmd }}" class="btn btn-success m-2">
                            Cetak
                        </a>
                    </div>
                    <div class="card-header">
                        <h5 class="m-0 font-weight-bold text-primary"> Riwayat Rekam Medis <strong>{{ $pasien->no_rmd }}</strong> </h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th colspan="2" class="text-center text-primary">Informasi Pasien</th>
                            </tr>
                            <tr>
                                <th>Nama Pasien</th>
                                <td>: {{ $pasien->nama_pasien }}</td>
                            </tr>
                            <tr>
                                <th>Nik</th>
                                <td>: {{ $pasien->nik }}</td>
                            </tr>
                        <tr>
                            <th>Pekerjaan</th>
                            <td>: {{ $pasien->pekerjaan }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>: {{ $pasien->tanggal_lahir }}</td>
                        </tr>
                        <tr>
                            <th>Agama</th>
                            <td>: {{ $pasien->agama }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>: {{ $pasien->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>: {{ $pasien->alamat }}</td>
                        </tr>
                        <tr>
                            <th>No. Telp</th>
                            <td>: {{ $pasien->no_telp }}</td>
                        </tr>
                          <tr>
                            <th>Biaya</th>
                            <td>: {{ $pasien->askes }}</td>
                        </tr>
                        <tr>
                            <th>No Askes</th>
                            <td>: {{ $pasien->no_dana_sehat }}</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="text-center text-primary">Informasi Pemeriksaan</th>
                        </tr>
                        <tr>
                            <td colspan="2">

                                <table class="table table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th width="10%">Tgl</th>
                                            <th width="50%">SOAP</th>
                                            <th width="20%">Terapi</th>
                                            <th width="20%">Tindakan/KIE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kunjunganpasien as $datakunjungan)
                                            <tr>
                                                <td>{{$datakunjungan->tgl_kunjungan}}</td>
                                                <td>
                                                    <h6>
                                                        <b>(S) subjective:</b>
                                                    </h6>
                                                    <div class="mb-4">
                                                        <span>{{$datakunjungan->keluhan}}</span>
                                                    </div>
                                                    <h6>
                                                        <b>(O) objective:</b>
                                                    </h6>
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
                                                    <h6>
                                                        <b>(A) assessment:</b>
                                                    </h6>
                                                    <div class="mb-4">
                                                        <span>{{$datakunjungan->diagnosa}}</span>
                                                    </div>
                                                    <h6>
                                                        <b>(P) planning:</b>
                                                    </h6>
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
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </table> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('addon-script')
<!-- <script type="text/javascript">
  $(document).ready(function() {
        $('#UserData').DataTable();
    });
    </script> -->
@endpush
