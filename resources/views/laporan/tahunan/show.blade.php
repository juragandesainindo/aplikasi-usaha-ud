@extends('layouts.master')

@section('title','Laporan Tahunan')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan Tahunan - {{ $usaha->nama_usaha }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('laporan-tahunan') }}"><i
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
                                            Periode Tahun {{ $tahun }}
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

                                @if ($periode->count() == 0)

                                @else

                                {{-- Januari Start --}}
                                @include('laporan.tahunan.month.jan')
                                {{-- Januari End --}}

                                {{-- Februari Start --}}
                                @include('laporan.tahunan.month.feb')
                                {{-- Februari End --}}

                                {{-- Maret Start --}}
                                @include('laporan.tahunan.month.mar')
                                {{-- Maret End --}}

                                {{-- April Start --}}
                                @include('laporan.tahunan.month.apr')
                                {{-- April End --}}

                                {{-- MEI Start --}}
                                @include('laporan.tahunan.month.mei')
                                {{-- MEI End --}}

                                {{-- JUNI Start --}}
                                @include('laporan.tahunan.month.jun')
                                {{-- JUNI End --}}

                                {{-- JULI Start --}}
                                @include('laporan.tahunan.month.jul')
                                {{-- JULI End --}}

                                {{-- AGUSTUS Start --}}
                                @include('laporan.tahunan.month.aug')
                                {{-- AGUSTUS End --}}

                                {{-- SEPTEMBER Start --}}
                                @include('laporan.tahunan.month.sep')
                                {{-- SEPTEMBER End --}}

                                {{-- OKTOBER Start --}}
                                @include('laporan.tahunan.month.okt')
                                {{-- OKTOBER End --}}

                                {{-- NOVEMBER Start --}}
                                @include('laporan.tahunan.month.nov')
                                {{-- NOVEMBER End --}}

                                {{-- DESEMBER Start --}}
                                @include('laporan.tahunan.month.des')
                                {{-- DESEMBER End --}}

                                @endif
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
                <h4 class="modal-title">Filter Laporan Tahunan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('laporan-tahunan.show',$usaha->id) }}" method="GET">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
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
                <h4 class="modal-title">Print Laporan Tahunan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('laporan-tahunan.cetak',$usaha->id) }}" method="GET" target="_blank">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
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
                    <button type="submit" class="btn btn-primary">Print</button>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- Modal Print End-->
@endsection