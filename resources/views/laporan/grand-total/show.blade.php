@extends('layouts.master')

@section('title','Laporan Bulanan')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan Grand Total - {{ $usaha->nama_usaha }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('laporan-grand-total') }}"><i
                                    class="fas fa-backspace"></i>
                                Kembali</a></li>
                    </ol>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">No</th>
                                            <th rowspan="2">Bulan</th>
                                            <th colspan="2">Total Buah/KG</th>
                                            <th rowspan="2">Pembelian</th>
                                            <th rowspan="2">Penjualan</th>
                                            <th rowspan="2">Pendapatan</th>
                                            <th rowspan="2">Operasional+Gaji</th>
                                            <th rowspan="2">Total</th>
                                            <th rowspan="2">Selisih</th>
                                            <th rowspan="2">Terjual Lagi</th>
                                            <th rowspan="2">Sortir</th>
                                        </tr>
                                        <tr>
                                            <th>Pembelian</th>
                                            <th>Penjualan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($usaha as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @foreach ($periode->tonaseBeli as $tbeli)

                                                {{ $tbeli->tonase_beli }}
                                                @endforeach
                                            </td>
                                        </tr>

                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection