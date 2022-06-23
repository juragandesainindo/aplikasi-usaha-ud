@extends('layouts.master')
@section('title','Dashboard')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box shadow">
                        <span class="info-box-icon bg-info"><i class="far fa-copy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Usaha</span>
                            <span class="info-box-number">{{ $usaha }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box shadow">
                        <span class="info-box-icon bg-success"><i class="far fa-copy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Periode</span>
                            <span class="info-box-number">{{ $periode }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box shadow">
                        <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Tonase Beli</span>
                            <span class="info-box-number">{{ number_format($tonaseBeli) }} Kg</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box shadow">
                        <span class="info-box-icon bg-danger"><i class="far fa-copy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Tonase Jual</span>
                            <span class="info-box-number">{{ number_format($tonaseJual) }} Kg</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box shadow">
                        <span class="info-box-icon bg-info"><i class="far fa-copy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Biaya Produksi</span>
                            <span class="info-box-number">Rp. {{ number_format($biaya) }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box shadow">
                        <span class="info-box-icon bg-success"><i class="far fa-copy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Gaji</span>
                            <span class="info-box-number">Rp.&nbsp;{{ number_format($gaji) }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box shadow">
                        <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Pembelian</span>
                            <span class="info-box-number">Rp.&nbsp;{{ number_format($pembelian) }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box shadow">
                        <span class="info-box-icon bg-danger"><i class="far fa-copy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Penjualan</span>
                            <span class="info-box-number">Rp.&nbsp;{{ number_format($penjualan) }}</span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-body">


                    <div class="row">
                        <div class="col-6">

                            <canvas id="sales-chart"></canvas>
                        </div>
                        <div class="col-6">

                            <canvas id="chartDashboard"></canvas>
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

@section('js')

@endsection