@extends('layouts.dashboard')
@section('title','Data Tindakan | Dokter' )
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pemeriksaan</h1>
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
                                        <th>No</th>
                                        <th>no_rm</th>
                                        <th>No Periksa</th>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th>Tanggal Kunjungan</th>
                                        <th>Diameter</th>
                                        <th>Jumlah</th>
                                        <th>Posisi</th>
                                        <th>Foto Fisik</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kunjungan as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->pasien->no_rmd }}</td>
                                        <td>{{ $data->no_periksa }}</td>
                                        <td>{{ $data->pasien->nama_pasien }}</td>
                                        @if($data->status == '0')
                                        <td><span class="mb-1 badge font-medium badge-secondary py-2 px-3 fs-7">Menunggu</span></td>
                                        @elseif($data->status == '1')
                                        <td><span class="mb-1 badge font-medium badge-primary py-2 px-3 fs-7">Diperiksa</span></td>
                                        @elseif($data->status == '2')
                                      <td><span class="mb-1 badge font-medium badge-success py-2 px-3 fs-7">Selesai</span></td>
                                        @endif
                                        <td>{{ $data->tgl_kunjungan }}</td>
                                        <td>{{ $data->diameter }}</td>
                                        <td>{{ $data->jumlah }}</td>
                                        <td>{{ $data->posisi }}</td>
                                        <td>
                                        @if($data->foto == 'NULL')
                                        Foto tidak tersedia
                                        @else
                                            
                                            <a href="{{ Storage::url($data->foto) }}" data-lightbox="gallery">
                                                <img src="{{ Storage::url($data->foto) }}" alt="Foto Fisik" style="min-width: 50px; max-width: 90px;">
                                            </a>
                                        @endif
                                    </td>
                                        <td>
                                          <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                     Aksi
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                    
                                                    <li><a data-bs-toggle="modal" data-bs-target="#foto{{ $data->id }}" class="dropdown-item">Periksa</a></li>
                                                    <li>
                                                        <a href="{{ route('detailperiksa.index', ['id_periksa' => $data->id]) }}" class="dropdown-item">Detail</a>
                                                    </li>  
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="foto{{ $data->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Periksa</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST"
                                                        action="{{ route('pemeriksaandokter.update', $data-> id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="exampleInputEmail1"
                                                                class="form-label">No Periksa</label>
                                                            <input value="{{ $data->no_periksa }}" type="text" name="no_periksa"
                                                                class="form-control" id="exampleInputEmail1"
                                                                aria-describedby="emailHelp" readonly>
                                                                <div class="mb-3">
                                                                    <div class="mb-3">
                                                            <label for="exampleInputEmail1"
                                                                class="form-label">No Rmd</label>
                                                            <input value="{{ $data->pasien->no_rmd }}" type="text" name="no_rmd"
                                                                class="form-control" id="exampleInputEmail1"
                                                                aria-describedby="emailHelp" readonly>
                                                            <label for="exampleInputEmail1"
                                                                class="form-label">Nama Pasien</label>
                                                            <input value="{{ $data->pasien->nama_pasien }}" type="text" name="nama_pasien"
                                                                class="form-control" id="exampleInputEmail1"
                                                                aria-describedby="emailHelp" readonly>
                                                                <div class="mb-3">
                                                            <label for="exampleInputEmail1"
                                                                class="form-label">Alergi</label>
                                                            <input value="{{ $data->alergi }}" type="text" name="alergi"
                                                                class="form-control" id="exampleInputEmail1"
                                                                aria-describedby="emailHelp" readonly>
                                                        <div class="mb-3">
                                                            <label for="exampleInputEmail1"
                                                                class="form-label">Diagnosa</label>
                                                            <input value="{{ $data->diagnosa }}" type="text" name="diagnosa"
                                                                class="form-control" id="exampleInputEmail1"
                                                                aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="keterangan_dokter"
                                                                class="form-label">Keterangan</label>
                                                            <input value="{{ $data->keterangan_dokter }}" type="text" name="keterangan_dokter"
                                                                class="form-control" id="exampleInputEmail1"
                                                                aria-describedby="emailHelp">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleInputEmail1" class="form-label">Tindakan</label>
                                                            <select class="form-control" name="tindakan" id="tindakan">
                                                                @foreach ($tindakan as $item)
                                                                    
                                                                <option value="{{ $item->nama_tindakan }}">{{ $item->nama_tindakan }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                            
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Kembali</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                        </div> 
                        @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                        <th>no_rm</th>
                                        <th>No Periksa</th>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th>Tanggal Kunjungan</th>
                                        <th>Diameter</th>
                                        <th>Jumlah</th>
                                        <th>Posisi</th>
                                        <th>Foto Fisik</th>
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

@endsection
@push('addon-script')
<script type="text/javascript">
   
  $(document).ready(function() {
        $('#UserData').DataTable();
    });
    </script>
    
@endpush
