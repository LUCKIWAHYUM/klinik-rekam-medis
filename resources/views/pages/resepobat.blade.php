@extends('layouts.dashboard')
@section('title','Data Resep Obat | Dokter' )
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
                                        <th>no_rm</th>
                                        <th>No Periksa</th>
                                        <th>Nama</th>
                                         <!-- <th>Alergi</th>
                                        <th>Diagnosa</th>
                                        <th>Tindakan</th> -->
                                        <th>Status</th>
                                        <th>Tanggal Kunjungan</th>
                                        <th>Waktu Kunjungan</th>
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
                                        <!-- <td>{{ $data->alergi }}</td>
                                        <td>{{ $data->diagnosa }}</td>
                                         <td> @if ($data->tindakan)
                                            @foreach ($data->tindakan as $nama_tindakan)
                                                <ul>
                                                    <li>{{ $nama_tindakan }}</li>
                                                </ul>
                                            @endforeach
                                        @endif</td> -->
                                        @if($data->status == '0')
                                        <td><span class="mb-1 badge font-medium badge-secondary py-2 px-3 fs-7">Menunggu</span></td>
                                        @elseif($data->status == '1')
                                         <td><span class="mb-1 badge font-medium badge-primary py-2 px-3 fs-7">Diperiksa</span></td>
                                        @elseif($data->status == '2')
                                      <td> <span class="mb-1 badge font-medium badge-success py-2 px-3 fs-7">Selesai</span></td>
                                        @endif
                                        <td>{{ $data->tgl_kunjungan }}</td>
                                        <td>{{ $data->waktu_kunjungan }}</td>
                                        <td>

                                          <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                     Aksi
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                    <!-- <li><a data-bs-toggle="modal" data-bs-target="#editUser{{ $data->id }}" class="dropdown-item">Buat Resep</a></li> -->
                                                    <li><li> <a href="{{ route('detail.index', ['id_periksa' => $data->id]) }}" class="dropdown-item">Detail</a></li> </li>
                                                    <li><a data-bs-toggle="modal" data-bs-target="#deletedata{{$data->id}}" class="dropdown-item text-danger">Hapus Resep</a></li>
                                                </ul>
                                            </div>
                                            @if($data->status == "0")
                                            <form action="{{ route('resepobat.update', $data->id) }}"
                                           method="POST">
                                                        @csrf
                                                         @method('PUT')
                                                        <input type="hidden" name="status" value="2">
                                                        <button type="submit" class="btn btn-success m-1">selesai</button>
                                        </form>
                                        @elseif($data->status == "1")
                                          <form action="{{ route('resepobat.update', $data->id) }}"
                                           method="POST">
                                                        @csrf
                                                         @method('PUT')
                                                        <input type="hidden" name="status" value="2">
                                                        <button type="submit" class="btn btn-success m-1">selesai</button>
                                        </form>
                                        @endif
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="deletedata{{ $data->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data Resep Obat</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('resepobat.destroy', $data->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <p>Anda Yakin akan menghapus data resep obat {{ $data->nama_pasien }}?</p>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Keluar</button>
                                                    <button type="submit" class="btn btn-primary">Hapus</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- modal edit --}}

                        </div>

                            <div class="modal fade" id="editUser{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-3" id="exampleModalLabel">Tambah Resep Obat</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST"
                                            id="my-form{{$data->id}}"
                                                action="{{ route('resepobat.store') }}">
                                                @csrf
                                                @method('POST')
                                                        <input value="belum" type="hidden" name="status"
                                                        class="form-control" id="status"
                                                        aria-describedby="emailHelp">
                                                        <!-- <input value="{{ $data->id }}" type="hidden" name="id_periksa" class="form-control" id="id_periksa" aria-describedby="emailHelp"> -->
                                                

                                                
                                                <!-- <div class="row">
                                                    <div class="col-md-3">
                                                        <label for="id_obat0" class="form-label">Nama Obat</label>
                                                        <select name="id_obat[]" id="id_obat0" class="form-control">
                                                            @foreach($resep_obat as $data_obat)
                                                                @if($data_obat->stok > 0)
                                                                    <option value="{{$data_obat->id}}">{{$data_obat->nama_obat}}({{ $data_obat->satuan }})</option>
                                                                @else
                                                                <option value="{{$data_obat->id}}" disabled onclick="alert('Stok Habis')">{{$data_obat->nama_obat}} (Stok Habis)</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="deskripsi0" class="form-label">Deskripsi</label>
                                                        <input type="text" name="deskripsi[]" class="form-control" id="deskripsi0" aria-describedby="emailHelp">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="jumlah0" class="form-label">Jumlah</label>
                                                        <input type="text" name="jumlah[]" class="form-control" id="jumlah0" aria-describedby="emailHelp">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="aturanpakai0" class="form-label">Aturan Pakai</label>
                                                        <input type="text" name="aturanpakai[]" class="form-control" id="aturanpakai0" aria-describedby="emailHelp">
                                                    </div>
                                                </div> -->


                                                <div id="entriesContainer{{ $data->id }}">
                                                        <!-- Container untuk field-field entri -->
                                                  </div>
                                            <button type="button" class="btn btn-secondary addEntryButton mb-3" data-id="{{ $data->id }}">+ Tambah Obat</button>

                                            <input type="hidden" name="id_periksa" value="{{ $data->id }}">
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1"
                                                        class="form-label">Pembelian Obat</label>
                                                        <select name="pembelian" id="pembelian"  class="form-control">
                                                            <option value="sendiri">Sendiri</option>
                                                            <option value="apotek">Apotek</option>
                                                        </select>
                                                        </div>
                                        
                                            <div class="mb-3">
                                                    <label for="bb" class="form-label">Berat Badan</label>
                                                    <input value="{{ $data->bb }}" type="text" name="bb" class="form-control" id="exampleColumn" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="usia" class="form-label">Usia</label>
                                                    <input value="{{ $data->pasien->usia }}" type="text" name="usia" class="form-control" id="exampleColumn" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="td" class="form-label">Tekanan Darah</label>
                                                    <input value="{{ $data->td }}" type="text" name="td" class="form-control" id="exampleColumn" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="nadi" class="form-label">Nadi</label>
                                                    <input value="{{ $data->nadi }}" type="text" name="nadi" class="form-control" id="exampleColumn" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="alergi" class="form-label">Alergi</label>
                                                    <input value="{{ $data->alergi }}" type="text" name="alergi" class="form-control" id="exampleColumn" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="diagnosa" class="form-label">Diagnosa</label>
                                                    <input value="{{ $data->diagnosa }}" type="text" name="diagnosa" class="form-control" id="exampleColumn" readonly>
                                                </div>
                                            
                                                </div>
                                        
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                            </form>
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
                                         <!-- <th>Alergi</th>
                                        <th>Diagnosa</th>
                                        <th>Tindakan</th> -->
                                        <th>Status</th>
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
        let inputIndex = 1;

        $('.addEntryButton').click(function() {
            const id_periksa = $(this).attr('data-id');
            console.log(id_periksa);
            // const status = $('#status').val();
            // const pembelian = $('#pembelian').val();

            const inputHtml = `
            <div class="row">
                <div class="col-md-3">
                    <label for="id_obat${inputIndex}" class="form-label">Nama Obat</label>
                    <select name="id_obat[]" id="id_obat${inputIndex}" class="form-control">
                        @foreach($resep_obat as $data)
                            @if($data->stok > 0)
                                <option value="{{$data->id}}">{{$data->nama_obat}}({{ $data->satuan }}) (stok {{ $data->stok }})</option>
                            @else
                            <option value="{{$data->id}}" disabled onclick="alert('Stok Habis')">{{$data->nama_obat}} (Stok Habis)</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-3">
                    <label for="deskripsi${inputIndex}" class="form-label">Deskripsi</label>
                    <input type="text" name="deskripsi[]" class="form-control" id="deskripsi${inputIndex}" aria-describedby="emailHelp">
                </div>
                <div class="col-md-3">
                    <label for="jumlah${inputIndex}" class="form-label">Jumlah</label>
                    <input type="text" name="jumlah[]" class="form-control" id="jumlah${inputIndex}" aria-describedby="emailHelp">
                </div>
                <div class="col-md-3">
                    <label for="aturanpakai${inputIndex}" class="form-label">Aturan Pakai</label>
                    <input type="text" name="aturanpakai[]" class="form-control" id="aturanpakai${inputIndex}" aria-describedby="emailHelp">
                </div>
            </div>
            `;

            $(`form#my-form${id_periksa}`).append(inputHtml);
            inputIndex++;
            
        });
    });
  $(document).ready(function() {
        $('#UserData').DataTable();
    });
    </script>
@endpush
