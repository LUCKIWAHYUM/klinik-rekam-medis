@extends('layouts.dashboard')
@section('title','Data Rekap Kesakitan | Administrasi' )
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Rekap Kesakitan</h1>
    </div>

    <!-- Content Row -->
    {{-- <div class="row"> --}}
    <div class="dashboard-content mb-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            
                                <div class="col-md-2">
                                    <select name="bulan" id="bulan" class="form-control">
                                        <option value="">Semua Bulan</option>
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
                        <div class="table-responsive mt-3">
                            <table id="UserData" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center">No</th>
                                        <th rowspan="2" class="text-center">Diagnosa</th>
                                        <th colspan="2" class="text-center">Jenis Kelamin</th>
                                        <th colspan="9" class="text-center" width="900px">Umur</th>
                                        <th rowspan="2" class="text-center">Jumlah</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Laki-Laki</th>
                                        <th class="text-center">Perempuan</th>
                                        
                                        <th class="text-center">0-5</th>
                                        <th class="text-center">6-11</th>
                                        <th class="text-center">12-16</th>
                                        <th class="text-center">17-25</th>
                                        <th class="text-center">26-35</th>
                                        <th class="text-center">36-45</th>
                                        <th class="text-center">46-55</th>
                                        <th class="text-center">56-65</th>
                                        <th class="text-center">>65</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach($periksa as $data)
                                    <tr>
                                        <td> {{$no++}} </td>
                                        <!-- <td>{{ $data->kode }}</td> -->
                                        <td>{{ $data->diagnosa }}</td>

                                        <!-- Jenis Kelamin -->
                                        <td>{{ $data->pria }}</td>
                                        <td>{{ $data->wanita }}</td>

                                        <!-- Umur -->
                                        <td>{{ $data->balita }}</td>
                                        <td>{{ $data->anak }}</td>
                                        <td>{{ $data->remaja_awal }}</td>
                                        <td>{{ $data->remaja_akhir }}</td>
                                        <td>{{ $data->dewasa_awal }}</td>
                                        <td>{{ $data->dewasa_akhir }}</td>
                                        <td>{{ $data->lansia_awal }}</td>
                                        <td>{{ $data->lansia_akhir }}</td>
                                        <td>{{ $data->manula }}</td>

                                        <!-- TOTAL -->
                                        <td>{{ $data->total }}</td>
                                     </tr>
                                     

                                    @endforeach

                                    {{-- modal --}}


                                </tbody>
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
    });
  $(document).ready(function() {
        $('#UserData').DataTable({
            "ordering": false    // Menyembunyikan fitur pengurutan
        });
    });
    
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Dapatkan nilai bulan dan tahun dari parameter URL (jika ada)
        var urlParams = new URLSearchParams(window.location.search);
        var selectedMonth = urlParams.get('bulan');
        var selectedYear = urlParams.get('tahun');

        // Setel nilai terpilih pada elemen <select> bulan dan tahun (jika nilai tersedia)
        var selectMonth = document.getElementById('bulan');
        var selectYear = document.getElementById('tahun');

        if (selectedMonth) {
            selectMonth.value = selectedMonth;
        }

        if (selectedYear) {
            selectYear.value = selectedYear;
        }
    });
function print() {
    // Dapatkan nilai yang dipilih dari elemen <select> bulan dan tahun
    var selectedMonth = document.getElementById('bulan').value;
    var selectedYear = document.getElementById('tahun').value;

    // Buat URL dengan parameter yang dipilih
    var url = "{{ route('cetak.sakit') }}?";
    if (selectedMonth) {
        url += "bulan=" + selectedMonth + "&";
    }
    if (selectedYear) {
        url += "tahun=" + selectedYear + "&";
    }

    // Hapus karakter '&' terakhir jika ada
    url = url.slice(0, -1);

    // Redirect ke URL yang dibangun
    window.location.href = url;
}
function handleSubmit() {
    // Dapatkan nilai yang dipilih dari elemen <select> bulan dan tahun
    var selectedMonth = document.getElementById('bulan').value;
    var selectedYear = document.getElementById('tahun').value;

    // Buat URL dengan parameter yang dipilih
    var url = "{{ route('rekapkesakitan.index') }}?";
    if (selectedMonth) {
        url += "bulan=" + selectedMonth + "&";
    }
    if (selectedYear) {
        url += "tahun=" + selectedYear + "&";
    }

    // Hapus karakter '&' terakhir jika ada
    url = url.slice(0, -1);

    // Redirect ke URL yang dibangun
    window.location.href = url;
}

</script>
@endpush
