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
                    @foreach ($kunjungan as $data)
                    <div>

                        <a href="/cetak-rekmed/{{ $data->id_periksa }}" class="btn btn-success m-2">
                            Cetak
                        </a>
                    </div>
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
                            <th>Nama Pasien</th>
                            <td>: {{ $data->nama_pasien }}</td>
                        </tr>
                        <tr>
                            <th>Nik</th>
                            <td>: {{ $data->nik }}</td>
                        </tr>
                        <tr>
                            <th>Pekerjaan</th>
                            <td>: {{ $data->pekerjaan }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>: {{ $data->tanggal_lahir }}</td>
                        </tr>
                        <tr>
                            <th>Agama</th>
                            <td>: {{ $data->agama }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>: {{ $data->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>: {{ $data->alamat }}</td>
                        </tr>
                        <tr>
                            <th>No. Telp</th>
                            <td>: {{ $data->no_telp }}</td>
                        </tr>
                          <tr>
                            <th>Biaya</th>
                            <td>: {{ $data->askes }}</td>
                        </tr>
                        <tr>
                            <th>No Askes</th>
                            <td>: {{ $data->no_dana_sehat }}</td>
                        </tr>                    
                        <tr>
                            <th>Tanggal Periksa</th>
                            <td>: {{ $data->tgl_kunjungan }}</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="text-center text-primary">Informasi Pemeriksaan</th>
                        </tr>
                         <tr>
                            <th>Keluhan</th>
                            <td>: {{ $data->keluhan }}</td>
                        </tr>
                        <tr>
                            <th>Alergi</th>
                            <td>: {{ $data->alergi }}</td>
                        </tr>
                        <tr>
                            <th>(S) subjective</th>
                            <td>: {{ $data->subjective }}</td>
                        </tr>
                        <tr>
                            <th>(O) objective</th>
                            <td>: {{ $data->objective }}</td>
                        </tr>
                        <tr>
                            <th>(A) assessment</th>
                            <td>: {{ $data->assessment }}</td>
                        </tr>
                        <tr>
                            <th>(P) plan</th>
                            <td>: {{ $data->plan }}</td>
                        </tr>
                        <tr>
                            <th>Diagnosa</th>
                            <td>: {{ $data->diagnosa }}</td>
                        </tr>
                        <tr>
                            <th colspan="2" class="text-center text-primary">Informasi Obat</th>
                        </tr>
                        @endforeach
                        @foreach ($resep as $data)
                        <tr>
                            <th>{{$data->nama_obat}} x 1</th>
                        
                        </tr>
                        @endforeach
                        @foreach ($kunjungan as $data)
                         <tr>
                            <th colspan="2" class="text-center text-primary">Informasi Tindakan</th>
                        </tr>
                            <tr>
                            <th>@foreach (($data->namatindakan) as $nama_tindakan)
                            <ul>
                                <li>{{ $nama_tindakan }}</li>
                            </ul>
                            @endforeach</th>
                          
                        </tr>
                        {{-- <tr>
                            <th colspan="2" class="text-center text-primary">Informasi Total Pembayaran</th>
                        </tr>
                        <tr>
                            <th>Total pembayaran</th>

                            <td>Rp. {{ number_format($totalobat + $data->hargatindakan, 0, ',', '.') }} </td>
             
                            
                        </tr>
                        <tr>
                            <th></th>
                            @if($data->statuspembayaran == "belum")
                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                            Bayar
                              </button></td>
                              @else
                              <td><span class="mb-1 badge font-medium badge-success py-2 px-3 fs-7">Lunas</span></td>
                              @endif
                        </tr> --}}
                      
                    </table> 
                   
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Pembayaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('detailpembayaran.store') }}">
                @csrf
                {{-- @foreach ($kunjungan as $data)
                <table class="m-2">
                    <tr>
                        <th colspan="2">Rincingan Pembayaran</th>
                    </tr>
                    <tr>
                        <th>List Obat</th>
                    </tr>
                    @foreach ($resep as $data)
                        <tr>
                            <th>{{$data->nama_obat}} x 1</th>
                            <td>: Rp. {{ number_format($data->harga, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                        <tr>
                            <th>Tindakan</th>
                        </tr>
                        <tr>
                            <th>{{ $data->tindakan }}</th>
                            @if($data->askes == "Dana_Sehat")
                            <td>Gratis</td>
                            @else
                            <td>{{ $data->hargatindakan }}</td>
                            @endif
                        </tr>
                </table>
                @endforeach --}}
                <div class="mb-3">
                    <label for="total" class="form-label">Total</label>
                    <input type="text" name="total" class="form-control" id="total" aria-describedby="emailHelp">
                    <input type="hidden" name="status" value="sudah bayar" class="form-control" id="total" aria-describedby="emailHelp">
                    <input type="hidden" name="id_periksa" value="{{ $data->id_periksa }}" class="form-control" id="total" aria-describedby="emailHelp">
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Selesaikan Pembayaran</button>
        </form>
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
