<!-- Modal Create Start -->
<div class="modal fade" id="createGaji">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Gaji</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form action="{{ route('penjualan-periode-produksi-gaji.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Gaji (Rp)</label>
                        <input type="number" min="1" name="gaji" value="{{ old('gaji') }}" class="form-control"
                            placeholder="contoh : 3000000" required>
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

<!-- Modal Delete Start -->
@switch($delete)
@case(1)
@foreach ($periode->gaji as $item)
<div class="modal fade" id="deleteGaji-{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500">Apakah yakin ingin menghapus Gaji?</strong></h4>

                <form action="{{ route('penjualan-periode-produksi-gaji.destroy',$item->id) }}" method="post">
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

@if ($periode->gaji->count() == 0)
<a href="#" class="btn btn-primary mb-4" data-toggle="modal" data-target="#createGaji" type="button">Tambah
    Gaji</a>
@else
<h4 class="text-secondary h4">Gaji</h4>
@endif

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Gaji</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($periode->gaji as $key => $item)
            <tr>
                <td>Rp.&nbsp;{{ number_format($item->gaji) }}</td>
                <td>
                    <a href="#" class="btn btn-danger btn-sm" data-toggle="modal"
                        data-target="#deleteGaji-{{ $item->id }}" type="button"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</div>