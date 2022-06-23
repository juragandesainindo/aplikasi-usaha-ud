@extends('layouts.master')

@section('title','Laporan Harian')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-8">
                    <h1 class="m-0">Laporan Harian {{ \Carbon\Carbon::parse($periode->tanggal_awal)->isoFormat('DD')
                        }}-{{
                        \Carbon\Carbon::parse($periode->tanggal_akhir)->isoFormat('DD/MM/Y') }} ({{
                        $periode->datausaha->nama_usaha }})
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('laporan-harian') }}"><i
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
                        <div class="card-body mb-30">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="h4 text-blue mb-20">A. Pembelian</h5>
                                </div>
                                <div class="col-6 text-right mb-2">
                                    <a href="{{ route('laporan-harian.cetak',['id'=>$periode->id,'slug'=>$periode->slug]) }}"
                                        class="btn btn-success"><i class="fas fa-print"></i> &nbsp;Print
                                        PDF</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">No</th>
                                            <th rowspan="2">Nama Supplier</th>
                                            <th colspan="2">Super</th>
                                            <th colspan="2">Bulat</th>
                                            <th colspan="2">Sortiran</th>
                                            <th colspan="3">Total</th>
                                            <th rowspan="2">Total Biaya</th>
                                            <th rowspan="2">Total Tonase</th>
                                        </tr>
                                        <tr>
                                            <th>Harga</th>
                                            <th>Tonase</th>
                                            <th>Harga</th>
                                            <th>Tonase</th>
                                            <th>Harga</th>
                                            <th>Tonase</th>
                                            <th>Super</th>
                                            <th>Bulat</th>
                                            <th>Sortiran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($periode->pembelian as $key => $item)
                                        <tr>
                                            <td class="text-center">{{ ++$key }}</td>
                                            <td>{{ $item->nama_supplier }}</td>
                                            <td class="text-right">{{ number_format($item->harga_super) }}</td>
                                            <td class="text-center">{{ $item->tonase_super }}</td>
                                            <td class="text-right">{{ number_format($item->harga_bulat) }}</td>
                                            <td class="text-center">{{ $item->tonase_bulat }}</td>
                                            <td class="text-right">{{ number_format($item->harga_sortiran) }}</td>
                                            <td class="text-center">{{ $item->tonase_sortiran }}</td>
                                            <td class="text-right">Rp.&nbsp;&nbsp;{{ number_format($item->total_super)
                                                }}</td>
                                            <td class="text-right">Rp.&nbsp;&nbsp;{{ number_format($item->total_bulat)
                                                }}</td>
                                            <td class="text-right">Rp.&nbsp;&nbsp;{{
                                                number_format($item->total_sortiran) }}
                                            </td>
                                            <td class="text-right">Rp.&nbsp;&nbsp;{{ number_format($item->total_biaya)
                                                }}</td>
                                            <td class="text-center">{{ $item->total_tonase }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Total</th>
                                            <th></th>
                                            <th>{{ $tonasesuper }}</th>
                                            <th></th>
                                            <th>{{ $tonasebulat }}</th>
                                            <th></th>
                                            <th>{{ $tonasesortiran }}</th>
                                            <th>Rp.&nbsp;{{ number_format($totalsuper) }}</th>
                                            <th>Rp.&nbsp;{{ number_format($totalbulat) }}</th>
                                            <th>Rp.&nbsp;{{ number_format($totalsortiran) }}</th>
                                            <th>Rp.&nbsp;{{ number_format($totalbiaya) }}</th>
                                            <th>{{ number_format($totaltonase) }}</th>
                                        </tr>
                                        <tr>
                                            <th></th>
                                            <th>Grand Total</th>
                                            <th colspan="10" class="text-right">{{ number_format($grandtotalbeli) }}
                                            </th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="card-body mb-30">
                            <h5 class="h4 text-blue mb-20">B. Penjualan</h5>
                            <table class="table table-striped table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Penjual</th>
                                        <th>Harga Jual Produksi</th>
                                        <th>Tonase</th>
                                        <th>Total Harga Jual</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($periode->penjualan as $key => $item)
                                    <tr>
                                        <td class="text-center">{{ ++$key }}</td>
                                        <td>{{ $item->nama_penjual }}</td>
                                        <td class="text-right">Rp.&nbsp;&nbsp;{{ number_format($item->harga_jual) }}
                                        </td>
                                        <td class="text-center">{{ number_format($item->tonase_jual) }}</td>
                                        <td class="text-right">Rp.&nbsp;&nbsp;{{ number_format($item->total_jual) }}
                                        </td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Total</th>
                                        <th></th>
                                        <th>{{ $tonasejual }}</th>
                                        <th class="text-right">Rp.&nbsp;{{ number_format($totaljual) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="card-body mb-30">
                            <h5 class="h4 text-blue mb-20">C. Pendapatan Produksi</h5>
                            <table class="table table-striped table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Title</th>
                                        <th>Jumlah</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Harga Rata-Rata Perkilogram</td>
                                        <td>{{ number_format($hargaratarata) }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Selisih Tonase</td>
                                        <td>{{ number_format($selisihtonase) }}</td>
                                        <td>
                                            @if ($selisihtonase < 0) <span>Tidak Terjual</span>
                                                @else
                                                @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Selisih Harga</td>
                                        <td>Rp.&nbsp;{{ number_format($selisihharga) }}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Pendapatan Kotor Produksi</td>
                                        <td>Rp.&nbsp;{{ number_format($pendapatankotor) }}</td>
                                        <td>
                                            @if ($pendapatankotor < 0) Minus @else @endif </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-body mb-30">
                            <h5 class="h4 text-blue mb-20">D. Biaya Produksi</h5>
                            <table class="table table-striped table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Title Biaya</th>
                                        <th>Jumlah Biaya</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($periode->biaya as $key => $bi)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $bi->title_biaya }}</td>
                                        <td>Rp.&nbsp;{{ number_format($bi->jumlah_biaya) }}</td>
                                        <td></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Total Biaya</th>
                                        <th>Rp.&nbsp;{{ number_format($jumlahbiaya) }}</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="card-body mb-30">
                            <div class="pb-20 pd-20 d-flex justify-content-around">
                                <h5 class="h4 text-blue mb-20">E. Laba Rugi</h5>
                                <h5 class="h4 text-blue mb-20">Rp.&nbsp;{{ number_format($labarugi) }}</h5>
                                <h5 class="h4 text-blue mb-20">
                                    @if ($labarugi < 0) Minus @else @endif </h5>
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