@extends('layouts.dashboard')
@section('title','Data Rekap Obat | Administrasi' )
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Rekap Obat</h1>
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
                                    <select class="form-control" name="obat_id" id="obat_id">
                                        <option value="">Pilih Kategori</option>
                                    @foreach ($nameobat as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_obat }}</option>
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
                        <div class="table-responsive">
                            <table id="UserData" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Periksa</th>
                                        <th>Nama Pasien</th>
                                        <th>Nama Obat</th>
                                        <th>Jumlah Obat</th>
                                        <th>Total Harga</th>
                                        <th>Tanggal Kunjungan</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    @foreach($Obat as $data)
                                    <tr>
                                        <td> {{$no++}} </td>
                                        <td> {{$data->periksa->no_periksa}} </td>
                                        <td> {{$data->periksa->pasien->nama_pasien}} </td>
                                        <td> {{$data->obat->nama_obat}} </td>
                                        <td> {{$data->jumlah}} </td>
                                        <td> {{$data->obat->harga}} </td>
                                        <td> {{$data->periksa->tgl_kunjungan}} </td>
                                     </tr>
                                     

                                    @endforeach

                                    {{-- modal --}}


                        </tbody>
                        <tfoot>
                            <tr>
                                        <th colspan="4">Jumlah Obat</th>
                                        <th>{{ $totalobat }}</th>
                                        <th></th>
                                        <th></th>
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
    });
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
        var selectedObatId = urlParams.get('obat_id');

        // Setel nilai terpilih pada elemen <select> bulan dan tahun (jika nilai tersedia)
        var selectMonth = document.getElementById('bulan');
        var selectYear = document.getElementById('tahun');
        var selectobatId = document.getElementById('obat_id');

        if (selectedMonth) {
            selectMonth.value = selectedMonth;
        }

        if (selectedYear) {
            selectYear.value = selectedYear;
        }
        if (selectedObatId) {
            selectobatId.value = selectedObatId;
        }
    });
function print() {
    // Dapatkan nilai yang dipilih dari elemen <select> bulan dan tahun
    var selectedMonth = document.getElementById('bulan').value;
    var selectedYear = document.getElementById('tahun').value;
    var selectedObatId = document.getElementById('obat_id').value;

    // Buat URL dengan parameter yang dipilih
    var url = "{{ route('cetak.obat') }}?";
    if (selectedMonth) {
        url += "bulan=" + selectedMonth + "&";
    }
    if (selectedYear) {
        url += "tahun=" + selectedYear + "&";
    }
    if (selectedObatId) {
        url += "obat_id=" + selectedObatId + "&";
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
    var selectedObatId = document.getElementById('obat_id').value;

    // Buat URL dengan parameter yang dipilih
    var url = "{{ route('rekapobat.index') }}?";
    if (selectedMonth) {
        url += "bulan=" + selectedMonth + "&";
    }
    if (selectedYear) {
        url += "tahun=" + selectedYear + "&";
    }
    if (selectedObatId) {
        url += "obat_id=" + selectedObatId + "&";
    }

    // Hapus karakter '&' terakhir jika ada
    url = url.slice(0, -1);

    // Redirect ke URL yang dibangun
    window.location.href = url;
}

</script>
@endpush
