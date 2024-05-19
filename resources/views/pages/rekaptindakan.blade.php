@extends('layouts.dashboard')
@section('title','Data Rekap Tindakan | Administrasi' )
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Rekap Tindakan</h1>
    </div>

    <!-- Content Row -->
    {{-- <div class="row"> --}}
    <div class="dashboard-content mb-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                         <div class="col-md-2">
                                    <select class="form-control" name="tindakan" id="tindakan">
                                        <option value="">Pilih Kategori</option>
                                    @foreach ($datatindakan as $item)
                                    <option value="{{ $item->nama_tindakan }}">{{ $item->nama_tindakan }}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="bulan" id="bulan" class="form-control">
                                        <option value="">Pilih Bulan</option>
                                        @foreach($listbulan as $key => $nama_bulan)
                                            <option value="{{ $key }}">{{ $nama_bulan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select class="form-control" name="tahun" id="tahun">
                                        <option value="">Pilih Tahun</option>
                                        @php
                                            $startYear = 2010; // Tahun mulai
                                            $currentYear = date('Y'); // Tahun sekarang
                                                                
                                            // Perulangan untuk menghasilkan opsi tahun dari tahun mulai hingga tahun sekarang
                                            for ($year = $currentYear; $year >= $startYear; $year--) {
                                                // Buat opsi tahun
                                                echo '<option value="' . $year . '">' . $year . '</option>';
                                            }
                                        @endphp
                                    </select>                
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary" onclick="handleSubmit()">View</button>
                                    <button type="button" onclick="print()" class="btn btn-success">
                                        Print
                                    </button>

                                </div>
                                </div>
                            </div>
                        <div class="table-responsive">
                            <table id="UserData" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                         <th>No</th>
                                        <th>No Periksa</th>
                                        <th>Nama</th>
                                        <th>Tindakan</th>
                                        <!-- <th>Harga</th> -->
                                        <th>Tanggal Kunjungan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kunjungan as $data)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->no_periksa }}</td>
                                        <td>{{ $data->pasien->nama_pasien }}</td>
                                         <td> @if ($data->tindakan)
                                            @foreach ($data->tindakan as $nama_tindakan)
                                                <ul>
                                                    <li>{{ $nama_tindakan }}</li>
                                                </ul>
                                            @endforeach
                                        @endif</td>
                                        <!-- <td>@foreach (($data->hargatindakan) as $nama_tindakan)
                            <ul>
                                <li>{{ $nama_tindakan }}</li>
                            </ul>
                            @endforeach</td> -->
                                        <td>{{ $data->tgl_kunjungan }}</td>
</tr>
                                        @endforeach
        

                          

                        </tbody>
                        <tfoot>
                            <tr>
                                        <tr>
                                         <th>No</th>
                                        <th>No Periksa</th>
                                        <th>Nama</th>
                                        <th>Tindakan</th>
                                        <!-- <th>Harga</th> -->
                                        <th>Tanggal Kunjungan</th>
                                    </tr>
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
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Dapatkan nilai bulan dan tahun dari parameter URL (jika ada)
        var urlParams = new URLSearchParams(window.location.search);
        var selectedMonth = urlParams.get('bulan');
        var selectedYear = urlParams.get('tahun');
        var selectedTindakan = urlParams.get('tindakan');

        // Setel nilai terpilih pada elemen <select> bulan dan tahun (jika nilai tersedia)
        var selectMonth = document.getElementById('bulan');
        var selectYear = document.getElementById('tahun');
        var selecttindakan = document.getElementById('tindakan');

        if (selectedMonth) {
            selectMonth.value = selectedMonth;
        }

        if (selectedYear) {
            selectYear.value = selectedYear;
        }
        if (selectedTindakan) {
            selecttindakan.value = selectedTindakan;
        }
    });
function handleSubmit() {
    // Dapatkan nilai yang dipilih dari elemen <select> bulan dan tahun
    var selectedMonth = document.getElementById('bulan').value;
    var selectedYear = document.getElementById('tahun').value;
    var selectedTindakan = document.getElementById('tindakan').value;

    // Buat URL dengan parameter yang dipilih
    var url = "{{ route('rekaptindakan.index') }}?";
    if (selectedMonth) {
        url += "bulan=" + selectedMonth + "&";
    }
    if (selectedYear) {
        url += "tahun=" + selectedYear + "&";
    }
    if (selectedTindakan) {
        url += "tindakan=" + selectedTindakan + "&";
    }

    // Hapus karakter '&' terakhir jika ada
    url = url.slice(0, -1);

    // Redirect ke URL yang dibangun
    window.location.href = url;
}

</script>
@endpush
