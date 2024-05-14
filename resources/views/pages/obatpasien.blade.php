@extends('layouts.dashboard')
@section('title','Data Resep Obat | Apoteker' )
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Resep Obat</h1>
    </div>

    <!-- Content Row -->
    {{-- <div class="row"> --}}
    <div class="dashboard-content mb-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="UserData" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>no_periksa</th>
                                        <th>Nama</th>
                                        <th>Status Pemeriksaan</th>
                                        <th>Status Obat</th>
                                        <th>Pembelian Obat</th>
                                        <th>Tanggal Kunjungan</th>
                                        <th>Waktu Kunjungan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kunjungan as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->no_periksa }}</td>
                                        <td>{{ $data->nama_pasien }}</td>
                                        @if($data->statuspemeriksaan == '0')
                                        <td><span class="mb-1 badge font-medium badge-secondary py-2 px-3 fs-7">Menunggu</span></td>
                                        @elseif($data->statuspemeriksaan == '1')
                                         <td><span class="mb-1 badge font-medium badge-primary py-2 px-3 fs-7">Diperiksa</span></td>
                                        @elseif($data->statuspemeriksaan == '2')
                                      <td> <span class="mb-1 badge font-medium badge-success py-2 px-3 fs-7">Selesai</span></td>
                                        @endif

                                        @if($data->statusobat == 'belum')
                                        <td><span class="mb-1 badge font-medium badge-secondary py-2 px-3 fs-7">Menunggu</span></td>
                                        @elseif($data->statusobat == 'sudah diambil')
                                         <td><span class="mb-1 badge font-medium badge-success py-2 px-3 fs-7">Sudah Diambil</span></td>
                                        @else
                                      <td> <span class="mb-1 badge font-medium badge-danger py-2 px-3 fs-7">undifined</span></td>
                                        @endif
                                        <td>{{ $data->pembelian }}</td>
                                        <td>{{ $data->tgl_kunjungan }}</td>
                                        <td>{{ $data->waktu_kunjungan }}</td>
                                        <td>
                                          <a href="{{ route('detail.index', ['id_periksa' => $data->id_periksa]) }}" class="btn btn-primary m-1">Detail</a>

                                            @if($data->statusobat == 'belum')
                                            <form action="{{ route('obatpasien.update', $data->id_periksa) }}"
                                           method="POST">
                                                        @csrf
                                                         @method('PUT')
                                                        <input type="hidden" name="status" value="sudah diambil">
                                                        <button type="submit" class="btn btn-success m-1">selesai</button>
                                        </form>
                                        @elseif($data->statusobat == 'sudah diambil')
                                          <!-- <span class="bg-succes">SUKSES</span> -->
                                        @endif
                                        
                                        </td>
                                    </tr>
                        </div>
                                {{-- modal edit --}}
                                    <div class="modal fade" id="viewdetail" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-3" id="exampleModalLabel">Resep Obat Pasien</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>No Periksa:</strong> <span id="no_periksa">{{ $data->no_periksa}}</span></p>
                                                    <p><strong>Nama Pasien:</strong> <span id="nama_pasien">{{ $data->nama_pasien}}</span></p>
                                                    <p><strong>Nama Obat:</strong> <span id="nama_obat">{{ $data->nama_obat}}</span></p>
                                                    <p><strong>Aturan Pakai:</strong> <span id="aturanpakai">{{ $data->aturanpakai}}</span></p>
                                                    <p><strong>Deskripsi:</strong> <span id="deskripsi">{{ $data->deskripsi}}</span></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
        
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
                                        <th>no_periksa</th>
                                        <th>Nama</th>
                                        <th>Status Pemeriksaan</th>
                                        <th>Status Obat</th>
                                        <th>Pembelian Obat</th>
                                        <th>Tanggal Kunjungan</th>
                                        <th>Waktu Kunjungan</th>
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

{{-- modal add --}}
<div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-3" id="exampleModalLabel">Tambah Data Tindakan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('kunjungan.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_tindakan" class="form-label">Nama Pasien</label>
                        <select class="form-control" name="pasien_id" id="pasien_id">
                            <option value="">Pilih Pasien</option>
                            @foreach($pasien as $data)
                            <option value="{{$data->id}}">{{$data->nama_pasien}}({{ $data->no_rmd }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama_tindakan" class="form-label">Nama Pasien</label>
                        <select class="form-control" name="user_id" id="user_id">
                            <option value="">Pilih Dokter</option>
                            @foreach($dokter as $data)
                            <option value="{{$data->id}}">{{$data->name}}({{ $data->nip }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tgl_kunjungan" class="form-label">Tanggal Kunjungan</label>
                        <input type="date" name="tgl_kunjungan" class="form-control" id="tgl_kunjungan" aria-describedby="emailHelp">
                        <input type="hidden" name="status" class="form-control" id="status" aria-describedby="emailHelp" value="0">
                    </div>
                    <div class="mb-3">
                        <label for="tgl_kunjungan" class="form-label">Waktu Kunjungan</label>
                        <input type="time" name="waktu_kunjungan" class="form-control" id="waktu_kunjungan" aria-describedby="emailHelp">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
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

