@extends('layouts.master')

@section('title','Periode')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Periode</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row clearfix">
                        @foreach ($usaha as $item)
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                            <div class="card card-box">
                                <img class="card-img-top p-4"
                                    src="{{ asset('assets/vendors/images/deskapp-logo.svg') }}" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold mb-2">{{ $item->nama_usaha }}</h5>
                                    <p class="card-text">Total Periode = <strong>{{ $item->periode->count()
                                            }}</strong></p>
                                    <a href="{{ route('periode.show',['id'=>$item->id, 'slug'=>$item->slug]) }}"
                                        class="btn btn-primary btn-sm">Go</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection