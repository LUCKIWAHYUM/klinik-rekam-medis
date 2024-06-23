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
                                        <th>Keterangan</th>
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
                                        <td>{{ $data->keterangan }}</td>
                                        <td>
                                        @if($data->foto == 'NULL')
                                        Foto tidak tersedia
                                        @else
                                            
                                            <a href="{{ Storage::url($data->foto) }}" data-lightbox="gallery">
                                                <img src="{{ Storage::url($data->foto) }}" alt="Tidak Ada" style="min-width: 50px; max-width: 90px;">
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
                                                    <li><a data-bs-toggle="modal" data-bs-target="#editUser{{ $data->id }}" class="dropdown-item">Buat Resep Obat</a></li>
                                                    <li><a data-bs-toggle="modal" data-bs-target="#buatRujukan{{ $data->id }}" class="dropdown-item">Cetak Rujukan</a></li>
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
                                                        action="{{ route('pemeriksaandokter.update', $data->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-3">
                                                            <label for="keluhan" class="form-label"><strong>(S) subjective</strong></label>
                                                            <input value="{{ $data->keluhan }}" type="text" name="keluhan" class="form-control" id="exampleColumn">
                                                        </div>
                                                    
                                                     <div class="mb-3">
                                                            <label for="" class="form-label"><strong>(O) Objective</strong></label>
                                                            <div>
                                                                Tinggi Badan  <input type="text" class="form-control" name="tb" value="{{ $data->tb }}"><br>
                                                                Berat Badan       <input type="text" class="form-control" name="bb" value="{{ $data->bb }}" ><br>
                                                                Tekanan Darah     <input type="text" class="form-control" name="td" value="{{ $data->td }}" ><br>
                                                                Denyut Nadi       <input type="text" class="form-control" name="nadi" value="{{ $data->nadi }}" ><br>
                                                                Suhu Tubuh        <input type="text" class="form-control" name="suhutubuh" value="{{ $data->suhutubuh }}" ><br>
                                                                SPO2            <input type="text" class="form-control" name="spo2" value="{{ $data->spo2 }}" ><br>
                                                                Pernapasan/RR     <input type="text" class="form-control" name="pernapasan" value="{{ $data->pernapasan }}" ><br>
                                                                Pemeriksaan Lain  <input type="text" class="form-control" name="periksalain" value="{{ $data->periksalain }}" ><br>
                                                            </div>
                                                        </div>


                                                         <div class="mb-3">
                                                            <label for="diagnosa{{ $data->id }}" class="form-label"><strong>(A) assessment</strong></label>
                                                            <select class=" form-control" name="diagnosa" id="diagnosa{{ $data->id }}" style="width: 100%;" >
                                                                @foreach($penyakit as $data_penyakit)
                                                                    <option value="{{ $data_penyakit->nama_penyakit }}">{{ $data_penyakit->kode }} {{ $data_penyakit->nama_penyakit }}</option>
                                                                @endforeach
                                                        
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tindakan{{ $data->id }}" class="form-label"><strong>(P) planning</strong></label>
                                                            <select class="js-example-basic-multiple form-control" name="tindakan[]" multiple="multiple" id="tindakan{{ $data->id }}" style="width: 100%;" >
                                                                @foreach($tindakan as $data_tindakan)
                                                                    <option value="{{ $data_tindakan->nama_tindakan }}">{{ $data_tindakan->nama_tindakan }}</option>
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

                                    <div class="modal fade" id="buatRujukan{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form>
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-3" id="exampleModalLabel">Cetak Rujukan</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="tujuan" class="form-label">RS Tujuan</label>
                                                            <input value="" type="text" name="tujuan" class="form-control" required>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary btn-cetak-rujukan" data-id_periksa="{{$data->id}}">Cetak</button>
                                                    </div>
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
                                        <th>Status</th>
                                        <th>Tanggal Kunjungan</th>
                                        <th>Diameter</th>
                                        <th>Jumlah</th>
                                        <th>Posisi</th>
                                        <th>Keterangan</th>
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
    <?php foreach ($kunjungan as $data) { ?>
        $('#foto<?= $data->id ?> #tindakan<?= $data->id ?>').select2();
    <?php }?>

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


    $('.btn-cetak-rujukan').click(function (e) {
        e.preventDefault();
        const id_periksa = $(this).attr('data-id_periksa');
        const rs_tujuan = $(`#buatRujukan${id_periksa} input[name=tujuan]`).val()

        if (rs_tujuan == '') {
            alert('Masukkan RS Tujuan!')
            return;
        }

        window.location.href = `{{ route('cetak.rujukan') }}?id_periksa=${id_periksa}&tujuan=${rs_tujuan}`
    })
});
    
</script>    
@endpush
