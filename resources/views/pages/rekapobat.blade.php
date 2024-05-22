@extends('layouts.dashboard')
@section('title','Data Rekap Obat | Administrasi')
@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Rekap Obat</h1>
    </div>

    <!-- Content Row -->
    <div class="dashboard-content mb-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
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
                                        for ($year = $currentYear; $year >= $startYear; $year--) {
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
                                        <th>Nama Obat</th>
                                        <th>Jumlah Obat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($Obat as $data)
                                    <tr>
                                        <td> {{$no++}} </td>
                                        <td> {{$data->nama_obat}} </td>
                                        <td> {{$data->totalobat}} </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
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

document.addEventListener('DOMContentLoaded', function() {
    var urlParams = new URLSearchParams(window.location.search);
    var selectedMonth = urlParams.get('bulan');
    var selectedYear = urlParams.get('tahun');

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
    var selectedMonth = document.getElementById('bulan').value;
    var selectedYear = document.getElementById('tahun').value;

    var url = "{{ route('cetak.obat') }}?";
    if (selectedMonth) {
        url += "bulan=" + selectedMonth + "&";
    }
    if (selectedYear) {
        url += "tahun=" + selectedYear + "&";
    }

    url = url.slice(0, -1);
    window.location.href = url;
}

function handleSubmit() {
    var selectedMonth = document.getElementById('bulan').value;
    var selectedYear = document.getElementById('tahun').value;

    var url = "{{ route('rekapobat.index') }}?";
    if (selectedMonth) {
        url += "bulan=" + selectedMonth + "&";
    }
    if (selectedYear) {
        url += "tahun=" + selectedYear + "&";
    }

    url = url.slice(0, -1);
    window.location.href = url;
}
</script>
@endpush
