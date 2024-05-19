@extends('layouts.dashboard')
@section('title','Data Pembayaran | Admin' )
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pembayaran</h1>
    </div>

    <!-- Content Row -->
    {{-- <div class="row"> --}}
    <div class="dashboard-content mb-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div>
                    @else
                        @if(session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                    @endif
                        <div class="table-responsive">
                            <table id="UserData" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>No. rmd</th>
                                        <th>No. Periksa</th>
                                        <th>Nama Pasien</th>
                                        <th>Status</th>
                                        <th>Jenis Pasien</th>
                                        <th>Tanggal Kunjungan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kunjungan as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->no_rmd }}</td>
                                        <td>{{ $data->no_periksa }}</td>
                                        <td>{{ $data->nama_pasien }}</td>
                                        @if(empty($data->statuspembayaran) OR $data->statuspembayaran == 'belum')
                                        <td><span class="mb-1 badge font-medium badge-secondary py-2 px-3 fs-7">Menunggu pembayaran</span></td>
                                        @elseif($data->statuspembayaran == 'sudah bayar')
                                        <td><span class="mb-1 badge font-medium badge-success py-2 px-3 fs-7">Selesai</span></td>
                                        @endif
                                        <td>{{ $data->askes }}</td>
                                        <td>{{ $data->tgl_kunjungan }}</td>
                                        <td>
                                            <a href="{{ route('detailpembayaran.index', ['id_periksa' => $data->id_periksa]) }}" class="btn btn-primary m-1">Detail</a>
                                        </td>
                                        
                                        @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                    <th>ID</th>
                                    <th>No. rmd</th>
                                    <th>No. Periksa</th>
                                    <th>Nama Pasien</th>
                                    <th>Status</th>
                                    <th>Jenis Pasien</th>
                                    <th>Tanggal Kunjungan</th>
                                    <th>Aksi</th>
                            </tr>
                        </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
{{-- </div> --}}

@endsection
@push('addon-script')
<script type="text/javascript">
   
  $(document).ready(function() {
        $('#UserData').DataTable();
    });
    </script>
@endpush
