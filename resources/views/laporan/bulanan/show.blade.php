@extends('layouts.master')

@section('title','Laporan Bulanan')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan Bulanan - {{ $usaha->nama_usaha }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('laporan-bulanan') }}"><i
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
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h4>
                                        <strong>
                                            Periode Bulan {{ $bln }}/{{ $thn }}
                                        </strong>
                                    </h4>
                                </div>
                                <div class="col-6 text-right">
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#filter">
                                            <i class="fas fa-search"></i>&nbsp;&nbsp; Filter
                                        </button>
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#print">
                                            <i class="fas fa-print"></i>&nbsp;&nbsp; Cetak
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">No</th>
                                            <th rowspan="2">Tanggal</th>
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
                                        @forelse ($periode->sortBy('tanggal_awal') as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->tanggal_awal)->isoFormat('DD') }} - {{
                                                \Carbon\Carbon::parse($item->tanggal_akhir)->isoFormat('DD/MM/Y') }}
                                            </td>
                                            <td>{{ $item->pembelian->sum('total_tonase') }}</td>
                                            <td>{{ $item->penjualan->sum('tonase_jual') }}</td>
                                            <td>Rp.&nbsp;{{ number_format($item->pembelian->sum('total_biaya')) }}</td>
                                            <td>Rp.&nbsp;{{ number_format($item->penjualan->sum('total_jual')) }}</td>
                                            <td>Rp.&nbsp;{{
                                                number_format($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))
                                                }}</td>
                                            <td>Rp.&nbsp;{{ number_format($item->biaya->sum('jumlah_biaya') +
                                                $item->gaji->sum('gaji')) }}</td>

                                            <td>Rp.&nbsp;{{
                                                number_format(($item->penjualan->sum('total_jual')-$item->pembelian->sum('total_biaya'))-($item->biaya->sum('jumlah_biaya')
                                                +
                                                $item->gaji->sum('gaji'))) }}</td>
                                            <td>{{
                                                $item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase')
                                                }}
                                            </td>
                                            <td>{{ $item->sisa->sum('tonase_sisa_terjual') }}</td>
                                            <td>{{
                                                ($item->penjualan->sum('tonase_jual')-$item->pembelian->sum('total_tonase'))+$item->sisa->sum('tonase_sisa_terjual')
                                                }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <th colspan="12" class="text-center text-danger">Data tidak di temukan</th>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="2" class="text-center">Total</th>
                                            <th>{{ $tonaseBeli->sum('tonase_beli') }}</th>
                                            <th>{{ $tonaseJual->sum('tonase_jual') }}</th>
                                            <th>Rp.&nbsp;{{
                                                number_format($totalBeli->sum('total_biaya')) }}</th>
                                            <th>Rp.&nbsp;{{
                                                number_format($totalJual->sum('total_jual')) }}</th>
                                            <th>Rp.&nbsp;{{
                                                number_format(($totalJual->sum('total_jual'))-($totalBeli->sum('total_biaya')))
                                                }}</th>
                                            <th>Rp.&nbsp;{{
                                                number_format($biaya->sum('jumlah_biaya')+$gaji->sum('upah')) }}
                                            </th>
                                            <th>Rp.&nbsp;{{
                                                number_format(($totalJual->sum('total_jual')-$totalBeli->sum('total_biaya'))-($biaya->sum('jumlah_biaya')+$gaji->sum('upah')))
                                                }}</th>
                                            <th>{{ $tonaseJual->sum('tonase_jual')-$tonaseBeli->sum('tonase_beli') }}
                                            </th>
                                            <th>{{ $sisaJual->sum('tonase_sisa_terjual') }}</th>
                                            <th>{{
                                                ($tonaseJual->sum('tonase_jual')-$tonaseBeli->sum('tonase_beli'))+$sisaJual->sum('tonase_sisa_terjual')
                                                }}</th>
                                        </tr>
                                    </tfoot>
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






<!-- Modal Filter Start-->
<div class="modal fade" id="filter">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Filter Laporan Bulanan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('laporan-bulanan.show',$usaha->id) }}" method="GET">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="month">Bulan</label>
                            <select name="month" id="month" class="select2 form-control" required>
                                <option value="">Pilih bulan</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="year">Tahun</label>
                            <select name="year" id="year" class="select2 form-control" required>
                                {{ $last= date('Y')-100 }}
                                {{ $now = date('Y') }}
                                <option value="">Pilih Tahun</option>
                                @for ($i = $now; $i >= $last; $i--)

                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <input type="hidden" name="usahaId" value="{{ $usaha->id }}">

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Filter End-->

<!-- Modal Print Start-->
<div class="modal fade" id="print">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Print Laporan Bulanan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('laporan-bulanan.cetak',$usaha->id) }}" method="GET" target="_blank">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label for="month">Bulan</label>
                            <select name="month" id="month" class="select2 form-control" required>
                                <option value="">Pilih bulan</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="year">Tahun</label>
                            <select name="year" id="year" class="select2 form-control" required>
                                {{ $last= date('Y')-100 }}
                                {{ $now = date('Y') }}
                                <option value="">Pilih Tahun</option>
                                @for ($i = $now; $i >= $last; $i--)

                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <input type="hidden" name="usahaId" value="{{ $usaha->id }}">

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Print</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Print End-->
@endsection