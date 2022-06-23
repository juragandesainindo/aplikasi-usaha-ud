@extends('layouts.master')

@section('title','Pembelian Produksi')

@section('content')

<!-- Modal Create Start -->
<div class="modal fade" id="create">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pembelian</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="{{ route('pembelian-periode-produksi.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Supplier</label>
                        <input type="text" name="nama_supplier" value="{{ old('nama_supplier') }}" class="form-control"
                            required placeholder="Nama supplier">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Harga Super (Rp) <sup class="text-danger">Tanpa titik (.) dan koma
                                        (,)</sup></label>
                                <input type="number" min="1" name="harga_super" value="{{ old('harga_super') }}"
                                    class="form-control" placeholder="contoh : 3000" required>
                            </div>
                        </div>
                        <div class="col-6">

                            <div class="form-group">
                                <label>Tonase Super (Kg) <sup class="text-danger">Tanpa titik (.) dan koma
                                        (,)</sup></label>
                                <input type="text" name="tonase_super" value="{{ old('tonase_super') }}"
                                    class="form-control" placeholder="contoh : 181" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Harga Bulat (Rp) <sup class="text-danger">Tanpa titik (.) dan koma
                                        (,)</sup></label>
                                <input type="text" name="harga_bulat" value="{{ old('harga_bulat') }}"
                                    class="form-control" placeholder="contoh : 3000" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Tonase Bulat (Kg) <sup class="text-danger">Tanpa titik (.) dan koma
                                        (,)</sup></label>
                                <input type="text" name="tonase_bulat" value="{{ old('tonase_bulat') }}"
                                    class="form-control" placeholder="contoh : 181" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Harga Sortiran (Rp) <sup class="text-danger">Tanpa titik (.) dan koma
                                        (,)</sup></label>
                                <input type="text" name="harga_sortiran" value="{{ old('harga_sortiran') }}"
                                    class="form-control" placeholder="contoh : 3000" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Tonase Sortiran (Kg) <sup class="text-danger">Tanpa titik (.) dan koma
                                        (,)</sup></label>
                                <input type="text" name="tonase_sortiran" value="{{ old('tonase_sortiran') }}"
                                    class="form-control" placeholder="contoh : 181" required>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="periode_id" value="{{ $periode->id }}">

                    <input type="hidden" name="datausaha_id" value="{{ $periode->datausaha_id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Create End -->

<!-- Modal Edit Start -->
@switch($edit)
@case(1)
@foreach ($periode->pembelian as $item)
<div class="modal fade" id="edit-{{ $item->id }}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Pembelian</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="{{ route('pembelian-periode-produksi.update',$item->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Supplier</label>
                        <input type="text" name="nama_supplier" value="{{ $item->nama_supplier }}" class="form-control"
                            required placeholder="Nama supplier">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Harga Super (Rp) <sup class="text-danger">Tanpa titik (.) dan koma
                                        (,)</sup></label>
                                <input type="number" min="1" name="harga_super" value="{{ $item->harga_super }}"
                                    class="form-control" placeholder="contoh : 3000" required>
                            </div>
                        </div>
                        <div class="col-6">

                            <div class="form-group">
                                <label>Tonase Super (Kg) <sup class="text-danger">Tanpa titik (.) dan koma
                                        (,)</sup></label>
                                <input type="text" name="tonase_super" value="{{ $item->tonase_super }}"
                                    class="form-control" placeholder="contoh : 181" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Harga Bulat (Rp) <sup class="text-danger">Tanpa titik (.) dan koma
                                        (,)</sup></label>
                                <input type="text" name="harga_bulat" value="{{ $item->harga_bulat }}"
                                    class="form-control" placeholder="contoh : 3000" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Tonase Bulat (Kg) <sup class="text-danger">Tanpa titik (.) dan koma
                                        (,)</sup></label>
                                <input type="text" name="tonase_bulat" value="{{ $item->tonase_bulat }}"
                                    class="form-control" placeholder="contoh : 181" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Harga Sortiran (Rp) <sup class="text-danger">Tanpa titik (.) dan koma
                                        (,)</sup></label>
                                <input type="text" name="harga_sortiran" value="{{ $item->harga_sortiran }}"
                                    class="form-control" placeholder="contoh : 3000" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Tonase Sortiran (Kg) <sup class="text-danger">Tanpa titik (.) dan koma
                                        (,)</sup></label>
                                <input type="text" name="tonase_sortiran" value="{{ $item->tonase_sortiran }}"
                                    class="form-control" placeholder="contoh : 181" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-warning">Ya. edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@break
@endswitch
<!-- Modal Edit End -->

<!-- Modal Delete Start -->
@switch($delete)
@case(1)
@foreach ($periode->pembelian as $item)
<div class="modal fade" id="delete-{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500">Apakah yakin ingin menghapus Data <strong>{{
                        $item->nama_supplier }}?</strong></h4>

                <form action="{{ route('pembelian-periode-produksi.destroy',$item->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                        <div class="col-6">
                            <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                                data-dismiss="modal"><i class="fa fa-times"></i></button>
                            TIDAK
                        </div>
                        <div class="col-6">
                            <button type="submit"
                                class="btn btn-primary border-radius-100 btn-block confirmation-btn"><i
                                    class="fa fa-check"></i></button>
                            YA
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endforeach
@break
@endswitch
<!-- Modal Delete End -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pembelian {{ $periode->tanggal }} ({{
                        $periode->datausaha->nama_usaha }})</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('pembelian') }}"><i class="fas fa-backspace"></i>
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
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#create" type="button">
                                Tambah Data Pembelian</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="width: 5%">No</th>
                                            <th rowspan="2">Aksi</th>
                                            <th rowspan="2">Nama Supplier</th>
                                            <th colspan="2" class="text-center">Super</th>
                                            <th colspan="2" class="text-center">Bulat</th>
                                            <th colspan="2" class="text-center">Sortiran</th>
                                            <th colspan="3" class="text-center">Total</th>
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
                                            <td>{{ ++$key }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                        href="#" role="button" data-toggle="dropdown">
                                                        <i class="dw dw-more"></i>
                                                    </a>
                                                    <div
                                                        class="dropdown-menu dropdown-menu-left dropdown-menu-icon-list">
                                                        <a class="dropdown-item text-info" href="#" data-toggle="modal"
                                                            data-target="#edit-{{ $item->id }}" type="button"><i
                                                                class="fas fa-edit"></i> Edit</a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item text-danger" href="#"
                                                            data-toggle="modal" data-target="#delete-{{ $item->id }}"
                                                            type="button"><i class="fas fa-trash"></i>
                                                            Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $item->nama_supplier }}</td>
                                            <td>{{ number_format($item->harga_super) }}</td>
                                            <td>{{ $item->tonase_super }}</td>
                                            <td>{{ number_format($item->harga_bulat) }}</td>
                                            <td>{{ $item->tonase_bulat }}</td>
                                            <td>{{ number_format($item->harga_sortiran) }}</td>
                                            <td>{{ $item->tonase_sortiran }}</td>
                                            <td>Rp. {{ number_format($item->total_super) }}</td>
                                            <td>Rp. {{ number_format($item->total_bulat) }}</td>
                                            <td>Rp. {{ number_format($item->total_sortiran) }}</td>
                                            <td>Rp. {{
                                                number_format($item->total_biaya)
                                                }}</td>
                                            <td>{{
                                                number_format($item->total_tonase)
                                                }}</td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-center">Total</th>
                                            <th></th>
                                            <th>{{ $periode->pembelian->sum('tonase_super') }}
                                            </th>
                                            <th></th>
                                            <th>{{ $periode->pembelian->sum('tonase_bulat') }}</th>
                                            <th></th>
                                            <th>{{ $periode->pembelian->sum('tonase_sortiran') }}</th>

                                            <th>Rp.&nbsp;{{
                                                number_format($periode->pembelian->sum('total_super')) }}</th>
                                            <th>Rp.&nbsp;{{
                                                number_format($periode->pembelian->sum('total_bulat')) }}</th>
                                            <th>Rp.&nbsp;{{
                                                number_format($periode->pembelian->sum('total_sortiran')) }}</th>
                                            <th>Rp.&nbsp;{{
                                                number_format($periode->pembelian->sum('total_biaya')) }}</th>
                                            <th>{{
                                                $periode->pembelian->sum('total_tonase') }}</th>
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
@endsection

@section('js')
<script>
    $(function () {
            $("#example1").DataTable({
              "responsive": true, "lengthChange": false, "autoWidth": false,
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          });
</script>
@endsection