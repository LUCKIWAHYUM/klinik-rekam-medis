@extends('layouts.dashboard')
@section('title','Detail Resep Obat' )
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Resep Obat</h1>
    </div>
    <div class="dashboard-content mb-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">                               
                            <a href="/cetak/{{ request()->query('id_periksa'); }}" class="btn btn-success m-2">
                                Cetak
                            </a>
                        </div>
                        
                        @foreach($kunjungan as $data)
                      <div class="row">
    <div class="col-md-8">
    <table class="table">
        <tbody>
            <tr>
                <td style="font-size: 18px; width: 30%; font-weight: metalic;">No Periksa</td>
                <td style="font-size: 18px; font-weight: metalic;">: {{ $data->no_periksa }}</td>
            </tr>
            <tr>
                <td style="font-size: 18px; font-weight: metalic;">Nama Pasien</td>
                <td style="font-size: 18px; font-weight: metalic;">: {{ $data->nama_pasien }}</td>
            </tr>
            <tr>
                <td style="font-size: 18px; font-weight: metalic;">Berat Badan</td>
                <td style="font-size: 18px; font-weight: metalic;">: {{ $data->bb }}</td>
            </tr>
            <tr>
                <td style="font-size: 18px; font-weight: metalic;">Usia</td>
                <td style="font-size: 18px; font-weight: metalic;">: {{ $data->usia }}</td>
            </tr>
            <tr>
                <td style="font-size: 18px; font-weight: metalic;">Tekanan Darah</td>
                <td style="font-size: 18px; font-weight: metalic;">: {{ $data->td }}</td>
            </tr>
            <tr>
                <td style="font-size: 18px; font-weight: metalic;">Nadi</td>
                <td style="font-size: 18px; font-weight: metalic;">: {{ $data->nadi }}</td>
            </tr>
            <tr>
                <td style="font-size: 18px; font-weight: metalic;">Alergi</td>
                <td style="font-size: 18px; font-weight: metalic;">: {{ $data->alergi }}</td>
            </tr>
        </tbody>
    </table>
</div>



                        @endforeach
                        <table class="table">
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
                                    <th scope="row">{{$no++}}</th>
                                    <td>{{$data->nama_obat}}</td>
                                    <td>{{$data->aturanpakai}}</td>
                                    <td>{{$data->jumlah}}</td>
                                    <td>{{$data->satuan}}</td>
                                    <td>{{$data->deskripsi}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
