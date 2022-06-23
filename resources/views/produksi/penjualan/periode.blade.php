@extends('layouts.master')

@section('title','Penjualan Periode')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Penjualan Periode ({{ $usaha->nama_usaha }})</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('penjualan') }}"><i class="fas fa-backspace"></i>
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
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th rowspan="2">No</th>
                                        <th rowspan="2">Keterangan</th>
                                        <th rowspan="2">Tanggal</th>
                                        <th colspan="4">Total</th>
                                        <th rowspan="2">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th>Penjualan</th>
                                        <th>Biaya</th>
                                        <th>Gaji</th>
                                        <th>Sortir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($usaha->periode->sortByDesc('tanggal_awal')->values() as $key => $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>{{ $item->tanggal_awal }} - {{ $item->tanggal_akhir }}</td>
                                        <td>{{ $item->penjualan->count() }}</td>
                                        <td>{{ $item->biaya->count() }}</td>
                                        <td>{{ $item->gaji->count() }}</td>
                                        <td>{{ $item->sisa->count() }}</td>
                                        <td>
                                            <a href="{{ route('penjualan-periode-produksi',['id'=>$item->id, 'slug'=>$item->slug]) }}"
                                                class="btn btn-success btn-sm">
                                                Buat Penjualan</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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