<!-- Modal Create Start -->
<div class="modal fade" id="createPenjualan">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="{{ route('penjualan-periode-produksi-penjualan.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Penjual</label>
                        <input type="text" name="nama_penjual" value="{{ old('nama_penjual') }}" class="form-control"
                            required placeholder="Nama penjual">
                    </div>
                    <div class="form-group">
                        <label>Harga Jual (Rp)</label>
                        <input type="number" min="1" name="harga_jual" value="{{ old('harga_jual') }}"
                            class="form-control" placeholder="contoh : 3000" required>
                        <span class="text-danger">Tanpa titik (.) dan koma (,)</span>
                    </div>
                    <div class="form-group">
                        <label>Tonase Jual (Kg)</label>
                        <input type="number" name="tonase_jual" value="{{ old('tonase_jual') }}" class="form-control"
                            placeholder="contoh : 181" required>
                        <span class="text-danger">Tanpa titik (.) dan koma (,)</span>
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
@foreach ($periode->penjualan as $item)
<div class="modal fade" id="edit-{{ $item->id }}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="{{ route('penjualan-periode-produksi-penjualan.update',$item->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Penjual</label>
                        <input type="text" name="nama_penjual" value="{{ $item->nama_penjual }}" class="form-control"
                            required placeholder="Nama penjual">
                    </div>
                    <div class="form-group">
                        <label>Harga Jual (Rp)</label>
                        <input type="number" min="1" name="harga_jual" value="{{ $item->harga_jual }}"
                            class="form-control" placeholder="contoh : 3000" required>
                        <span class="text-danger">Tanpa titik (.) dan koma (,)</span>
                    </div>
                    <div class="form-group">
                        <label>Tonase Jual (Kg)</label>
                        <input type="number" name="tonase_jual" value="{{ $item->tonase_jual }}" class="form-control"
                            placeholder="contoh : 181" required>
                        <span class="text-danger">Tanpa titik (.) dan koma (,)</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-warning">Ya, edit</button>
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
@foreach ($periode->penjualan as $item)
<div class="modal fade" id="delete-{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500">Apakah yakin ingin menghapus Data <strong>{{
                        $item->nama_penjual }}?</strong></h4>

                <form action="{{ route('penjualan-periode-produksi-penjualan.destroy',$item->id) }}" method="post">
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

<a href="" class="btn btn-primary mb-4" data-toggle="modal" data-target="#createPenjualan" type="button">Tambah
    Penjualan</a>
<div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Penjual</th>
                <th>Harga Jual</th>
                <th>Tonase Jual</th>
                <th>Total Harga Jual</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($periode->penjualan as $key => $item)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $item->nama_penjual }}</td>
                <td>Rp.&nbsp;{{ number_format($item->harga_jual) }}</td>
                <td>{{ $item->tonase_jual }}</td>
                <td>Rp.&nbsp;{{ number_format($item->total_jual) }}</td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <a class="btn btn-warning btn-sm" href="#" data-toggle="modal"
                            data-target="#edit-{{ $item->id }}" type="button"><i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="#" data-toggle="modal"
                            data-target="#delete-{{ $item->id }}" type="button"><i class="fas fa-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th></th>
                <th colspan="2">Total</th>
                <th>{{ number_format($totaltonase) }}</th>
                <th>Rp.&nbsp;{{ number_format($totaljual) }}</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</div>