<?php

namespace App\Http\Controllers\produksi;

use App\Http\Controllers\Controller;
use App\Models\Datausaha;
use App\Models\Pembelian;
use App\Models\Periode;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function index()
    {
        $usaha = Datausaha::all();
        $edit = 1;
        return view('produksi.pembelian.index', compact('usaha', 'edit'));
    }

    public function periode($id, $slug)
    {
        $usaha = Datausaha::where('id', $id)->where('slug', $slug)->first();
        return view('produksi.pembelian.periode', compact('usaha'));
    }

    public function produksi($id, $slug)
    {
        $periode = Periode::where('id', $id)->where('slug', $slug)->first();
        $edit = 1;
        $delete = 1;
        return view('produksi.pembelian.produksi', compact('periode', 'edit', 'delete'));
    }

    public function storeProduksi(Request $request)
    {
        Pembelian::create([
            'nama_supplier'       => $request->nama_supplier,
            'harga_super'         => $request->harga_super,
            'tonase_super'        => $request->tonase_super,
            'harga_bulat'         => $request->harga_bulat,
            'tonase_bulat'        => $request->tonase_bulat,
            'harga_sortiran'      => $request->harga_sortiran,
            'tonase_sortiran'     => $request->tonase_sortiran,
            'total_super'         => $request->harga_super * $request->tonase_super,
            'total_bulat'         => $request->harga_bulat * $request->tonase_bulat,
            'total_sortiran'      => $request->harga_sortiran * $request->tonase_sortiran,
            'total_biaya'         => $request->harga_super * $request->tonase_super + $request->harga_bulat * $request->tonase_bulat + $request->harga_sortiran * $request->tonase_sortiran,
            'total_tonase'        => $request->tonase_super + $request->tonase_bulat + $request->tonase_sortiran,
            'periode_id'          => $request->periode_id,
            'datausaha_id'        => $request->datausaha_id,

        ]);

        Alert::success('Selamat', 'Tambah pembelian produksi berhasil');
        return back();
    }

    public function updateProduksi(Request $request, $id)
    {
        $produksi = Pembelian::findOrFail($id);
        $produksi->update([
            'nama_supplier'       => $request->nama_supplier,
            'harga_super'         => $request->harga_super,
            'tonase_super'        => $request->tonase_super,
            'harga_bulat'         => $request->harga_bulat,
            'tonase_bulat'        => $request->tonase_bulat,
            'harga_sortiran'      => $request->harga_sortiran,
            'tonase_sortiran'     => $request->tonase_sortiran,
            'total_super'         => $request->harga_super * $request->tonase_super,
            'total_bulat'         => $request->harga_bulat * $request->tonase_bulat,
            'total_sortiran'      => $request->harga_sortiran * $request->tonase_sortiran,
            'total_biaya'         => $request->harga_super * $request->tonase_super + $request->harga_bulat * $request->tonase_bulat + $request->harga_sortiran * $request->tonase_sortiran,
            'total_tonase'        => $request->tonase_super + $request->tonase_bulat + $request->tonase_sortiran,

        ]);

        Alert::warning('Selamat', 'Edit pembelian produksi berhasil');
        return back();
    }

    public function destroyProduksi($id)
    {
        Pembelian::findOrFail($id)->delete();

        Alert::error('Selamat', 'Hapus pembelian produksi berhasil');
        return back();
    }
}