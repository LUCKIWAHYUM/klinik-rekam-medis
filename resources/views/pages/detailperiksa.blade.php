@extends('layouts.dashboard')
@section('title','Detail Pembayaran' )
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pemeriksaan</h1>
    </div>
    <div class="dashboard-content mb-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    @foreach ($kunjungan as $data)
                    <div class="card-header">
                        <h5 class="m-0 font-weight-bold text-primary"> Informasi Pemeriksaan <strong>{{ $data->no_periksa }}</strong> </h5>
                        
                    </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="2" class="text-center text-primary">Informasi Pasien</th>
                        </tr>
                        <tr>
                            <th>No Rm</th>
                            <td>: {{ $data->no_rmd }}</td>
                        </tr>
                        <tr>
                            <th>No registrasi</th>
                            <td>: {{ $data->noregis }}</td>
                        </tr>
                        <tr>
                            <th>Nama Pasien</th>
                            <td>: {{ $data->nama_pasien }}</td>
                        </tr>
                        <tr>
                            <th>No Askes</th>
                            <td>: {{ $data->no_dana_sehat }}</td>
                        </tr>
                        <tr>
                            <th>Tipe Pasien</th>
                            <td>: {{ $data->askes }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Periksa</th>
                            <td>: {{ $data->tgl_kunjungan }}</td>
                        </tr>
                        <tr>
                            <th>Diagnosa</th>
                            <td>: {{ $data->diagnosa }}</td>
                        </tr>
                        <tr>
                            <th>Tindakan</th>
                            <td>: {{ $data->tindakan }}</td>
                        </tr>
                        <tr>
                            <th>Alergi</th>
                            <td>: {{ $data->alergi }}</td>
                        </tr>
                        <tr>
                            <th>Tinggi Badan</th>
                            <td>: {{ $data->tb }}</td>
                        </tr>
                        <tr>
                            <th>Berat Badan</th>
                            <td>: {{ $data->bb }}</td>
                        </tr>
                        <tr>
                            <th>Tekanan Darah</th>
                            <td>: {{ $data->nadi }}</td>
                        </tr>
                        <tr>
                            <th>Keluhan</th>
                            <td>: {{ $data->keluhan }}</td>
                        </tr>
                        <tr>
                            <th>Status Pemeriksaan</th>
                            @if($data->statuspemeriksaan == '0')
                                        <td><span class="mb-1 badge font-medium badge-secondary py-2 px-3 fs-7">Menunggu</span></td>
                                        @elseif($data->statuspemeriksaan == '1')
                                        <td><span class="mb-1 badge font-medium badge-primary py-2 px-3 fs-7">Diperiksa</span></td>
                                        @elseif($data->statuspemeriksaan == '2')
                                      <td><span class="mb-1 badge font-medium badge-success py-2 px-3 fs-7">Selesai</span></td>
                                        @endif
                        </tr>
                    </table> 
                   
                </div>
            </div>
        </div>
    </div>
</div>
  @endforeach
@endsection
@push('addon-script')
<!-- <script type="text/javascript">
  $(document).ready(function() {
        $('#UserData').DataTable();
    });
    </script> -->
@endpush
