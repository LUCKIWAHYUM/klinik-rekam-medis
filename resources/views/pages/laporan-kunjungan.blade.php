@extends('layouts.dashboard')
@section('title','Data Obat | Apoteker' )
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laporan Kunjungan</h1>
    </div>

    <!-- Content Row -->
    {{-- <div class="row"> --}}
    <div class="dashboard-content mb-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                         {{-- Pesan Sukses --}}
                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- Pesan Error --}}
                        @if(session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table id="UserData" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kunjungan as $item)
                                        
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->nama_bulan }}</td>
                                        <td>{{ $item->tahun }}</td>
                                        <td><a href="/cetak-laporan/{{ $item->bulan }}/{{ $item->tahun }}" class="btn btn-success m-2">
                                            Cetak
                                        </a></td>
                                    </tr>
                                    @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Bulan</th>
                                <th>Tahun</th>
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

