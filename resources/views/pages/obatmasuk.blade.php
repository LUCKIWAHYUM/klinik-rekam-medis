@extends('layouts.dashboard')
@section('title','Data Obat Masuk | Apoteker' )
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Obat</h1>
    </div>

    <!-- Content Row -->
    {{-- <div class="row"> --}}
    <div class="dashboard-content mb-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="" class="btn btn-primary mb-3" type="button" class="btn btn-primary"
                            data-bs-toggle="modal" data-bs-target="#adduser">
                            + Tambah Stok Obat
                        </a>
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
                        
                            !-- Tampilkan pesan peringatan di sini -->
    @if(session('warning'))
        <div class="alert alert-warning" role="alert">
            {{ session('warning') }}
        </div>
    @endif
                        @endif
                        <div class="table-responsive">
                            <table id="UserData" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama_Obat</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal Masuk</th>
                                    </tr>
                                </thead>    
                                <tbody>
                                   @foreach($obatmasuk as $item)
                                   <tr>
                                   <td>{{$no++ }}</td>
                                   <td>{{ $item->obat->nama_obat }}</td>
                                   <td>{{ $item->jumlah }}</td>
                                   <td>{{ $item->created_at }}</td>
                                   <!-- <td></td> -->
                                   </tr>
                                   @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                        <th>No</th>
                                        <th>Nama_Obat</th>
                                        <th>Jumlah</th>
                                         <th>Tanggal Masuk</th>
                                        <!-- <th>Aksi</th> -->
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

{{-- modal add --}}
<div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-3" id="exampleModalLabel">Tambah Obat Masuk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('obatmasuk.store') }}">
                    @csrf
                    <div class="mb-3">
               <select name="id_obat" class="form-control" id="">
                        @foreach($obat as $data)
                        <option value="{{ $data->id }}">{{ $data->nama_obat }}</option>
                        @endforeach
               </select>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input type="text" name="jumlah" class="form-control" id="jumlah" aria-describedby="emailHelp" required>
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
@push('addon-script')
<script type="text/javascript">
  $(document).ready(function() {
        $('#UserData').DataTable();
    });
    </script>
@endpush

