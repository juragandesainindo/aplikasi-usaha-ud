<!-- Modal Create Start -->
<div class="modal fade" id="createBiaya">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Biaya</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="{{ route('penjualan-periode-produksi-biaya.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Title Biaya</label>
                        <input type="text" name="title_biaya" value="{{ old('title_biaya') }}" class="form-control"
                            required placeholder="Nama penjual">
                    </div>
                    <div class="form-group">
                        <label>Jumlah Biaya (Rp)</label>
                        <input type="number" min="1" name="jumlah_biaya" value="{{ old('jumlah_biaya') }}"
                            class="form-control" placeholder="contoh : 3000" required>
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
@foreach ($periode->biaya as $item)
<div class="modal fade" id="editBiaya-{{ $item->id }}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Biaya</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="{{ route('penjualan-periode-produksi-biaya.update',$item->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Title Biaya</label>
                        <input type="text" name="title_biaya" value="{{ $item->title_biaya }}" class="form-control"
                            required placeholder="Nama penjual">
                    </div>
                    <div class="form-group">
                        <label>Jumlah Biaya (Rp)</label>
                        <input type="number" min="1" name="jumlah_biaya" value="{{ $item->jumlah_biaya }}"
                            class="form-control" placeholder="contoh : 3000" required>
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
@foreach ($periode->biaya as $item)
<div class="modal fade" id="deleteBiaya-{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500">Apakah yakin ingin menghapus Biaya <strong>{{
                        $item->title_biaya }}?</strong></h4>

                <form action="{{ route('penjualan-periode-produksi-biaya.destroy',$item->id) }}" method="post">
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

<a href="#" class="btn btn-primary mb-4" data-toggle="modal" data-target="#createBiaya" type="button">Tambah
    Biaya</a>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Title Biaya</th>
                <th>Jumlah Biaya</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($periode->biaya as $key => $item)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $item->title_biaya }}</td>
                <td>Rp.&nbsp;{{ number_format($item->jumlah_biaya) }}</td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <a class="btn btn-warning btn-sm" href="#" data-toggle="modal"
                            data-target="#editBiaya-{{ $item->id }}" type="button"><i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="#" data-toggle="modal"
                            data-target="#deleteBiaya-{{ $item->id }}" type="button"><i class="fas fa-trash"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>Total</th>
                <th colspan="2">Rp.&nbsp;{{ number_format($totalbiaya) }}</th>
            </tr>
        </tfoot>
    </table>
</div>