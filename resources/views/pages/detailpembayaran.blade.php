@extends('layouts.dashboard')
@section('title','Detail Pembayaran' )
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pembayaran</h1>
    </div>
    <div class="dashboard-content mb-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    
                    <div class="card-header">
                        @if($pemeriksaan->statuspembayaran == 'sudah bayar')
                        <a href="/cetak-nota/{{ $pemeriksaan->id_periksa }}" class="btn btn-success m-2">
                            Cetak
                        </a>
                        @endif
                        <h5 class="m-0 font-weight-bold text-primary"> Informasi Pembayaran <strong>{{ $pemeriksaan->no_periksa }}</strong> </h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th colspan="2" class="text-center text-primary">Informasi Pasien</th>
                            </tr>
                            <tr>
                                <th>No Rm</th>
                                <td>: {{ $pasien->no_rmd }}</td>
                            </tr>
                            <tr>
                                <th>Nama Pasien</th>
                                <td>: {{ $pasien->nama_pasien }}</td>
                            </tr>
                            <tr>
                                <th>No Periksa</th>
                                <td>: {{ $pemeriksaan->no_periksa }}</td>
                            </tr>
                            <tr>
                                <th>Tipe Pasien</th>
                                <td>: {{ $pasien->askes }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Periksa</th>
                                <td>: {{ $pemeriksaan->tgl_kunjungan }}</td>
                            </tr>
                        
                            
                            
                            <?php $totalhargaobat = 0 ?>
                            
                            @if (!empty($obat))
                                <tr>
                                    <th colspan="2" class="text-center text-primary">Informasi Obat</th>
                                </tr>
                                @foreach ($obat as $dataResep)
                                <tr>
                                    <?php $dataResep->harga = ($dataResep->pembelian == "sendiri") ? 0 : $dataResep->harga ; ?>
                                    <th>{{$dataResep->nama_obat}} x {{ $dataResep->jumlah }} ({{$dataResep->pembelian}})</th>
                                    <td>Rp. {{ number_format(($dataResep->harga*$dataResep->jumlah), 0, ',', '.') }}</td>
                                    <?php $totalhargaobat += ($dataResep->harga*$dataResep->jumlah) ?>
                                </tr>
                                @endforeach
                                <tr>
                                    <th>total harga</th>
                                    <td>Rp. {{ number_format($totalhargaobat, 0, ',', '.') }}</td>
                                </tr>
                            @endif


                            <tr>
                                <th colspan="2" class="text-center text-primary">Semua Total Biaya Tindakan</th>
                        </tr>
                        <tr>
                            <th>@foreach (($pemeriksaan->namatindakan) as $nama_tindakan)
                                <ul>
                                    <li>{{ $nama_tindakan }}</li>
                                </ul>
                                @endforeach</th>
                                
                                <th>@foreach (($pemeriksaan->hargatindakan) as $nama_tindakan)
                                    <ul>
                                        <li>{{ $nama_tindakan }}</li>
                                    </ul>
                                    @endforeach</th>
                                    
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-center text-primary">Informasi Total Pembayaran</th>
                                </tr>
                                <tr>
                                    <th>Total pembayaran</th>
                                    <td>Rp. {{ number_format($totalhargaobat + $pemeriksaan->total_harga_tindakan, 0, ',', '.') }}</td>
                                    
                                    
                                </tr>
                                <tr>
                                    <th></th>
                                    @if(empty($pemeriksaan->statuspembayaran) OR $pemeriksaan->statuspembayaran == 'belum')
                                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                        Bayar
                                    </button></td>
                                    @else
                                    <td><span class="mb-1 badge font-medium badge-success py-2 px-3 fs-7">Lunas</span>
                                    
                                </td>
                                @endif
                            </tr>
                            
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
                    
                        <div class="mb-3">
                            <label for="total" class="form-label">Total</label>
                            <input type="text" name="total" class="form-control" id="total" aria-describedby="emailHelp">
                            <input type="hidden" name="status" value="sudah bayar" class="form-control" id="total" aria-describedby="emailHelp">
                            <input type="hidden" name="id_periksa" value="{{ $pemeriksaan->id_periksa }}" class="form-control" id="total" aria-describedby="emailHelp">
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
@endsection
@push('addon-script')
<!-- <script type="text/javascript">
    $(document).ready(function() {
        $('#UserData').DataTable();
    });
</script> -->
@endpush
