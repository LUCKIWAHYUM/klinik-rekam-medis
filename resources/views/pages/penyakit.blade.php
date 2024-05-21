@extends('layouts.dashboard')
@section('title','Data Penyakit | Dokter' )
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Penyakit</h1>
    </div>

    <!-- Content Row -->
    {{-- <div class="row"> --}}
    <div class="dashboard-content mb-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="" class="btn btn-primary mb-3" type="button" class="btn btn-primary"
                            data-bs-toggle="modal" data-bs-target="#add">
                            + Upload Data Penyakit
                        </a>
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
                                        <th>kode ICD</th>
                                        <th>Nama_Penyakit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penyakit as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->kode }}</td>
                                        <td>{{ $data->nama_penyakit }}</td>
                                    </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>kode ICD</th>
                                <th>Nama_Penyakit</th>
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
<div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-3" id="exampleModalLabel">Tambah Data Penyakit</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="uploadForm" enctype="multipart/form-data" method="POST" action="{{ route('penyakit.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="file" class="form-label">Upload File Excel</label>
                        <input type="file" name="file" class="form-control" id="file">
                    </div>
                <!-- </form> -->
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

    <script>
        $(document).ready(function() {
            @if (session('success'))
                alert('File berhasil diunggah');
            @elseif (session('error'))
                alert('Terjadi kesalahan saat mengunggah file. Silakan coba lagi.');
            @endif

            // Tambahkan event listener untuk submit form
            $(document).on('submit', '#uploadForm', function(e) {
                e.preventDefault(); // Mencegah pengiriman form bawaan

                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: '{{ route('penyakit.store') }}',
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            // Tampilkan modal upload berhasil
                            reload();

                            // TODO: Lakukan pengolahan data Excel dan tampilkan di tabel
                        } else {
                            // Tampilkan modal upload gagal
                            console.log();
                        }

                        setTimeout(function () {
                            location . reload();
                        }, 1000);

                    },
                    error: function(xhr, status, error) {
                        // Tampilkan modal upload gagal
                        console.log();
                    }
                });
            });
        });
    </script>
@endpush

