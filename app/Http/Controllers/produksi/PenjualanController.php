<?php

namespace App\Http\Controllers\produksi;

use App\Http\Controllers\Controller;
use App\Models\Datausaha;
use App\Models\Penjualan;
use App\Models\Periode;
use App\Models\Biaya;
use App\Models\Gaji;
use App\Models\Sisaproduksi;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $usaha = Datausaha::all();
        return view('produksi.penjualan.index', compact('usaha'));
    }

    public function periode($id, $slug)
    {
        $usaha = Datausaha::where('id', $id)->where('slug', $slug)->first();
        return view('produksi.penjualan.periode', compact('usaha'));
    }

    public function produksi($id, $slug)
    {
        $periode = Periode::where('id', $id)->where('slug', $slug)->first();
        $edit = 1;
        $delete = 1;
        $tonasebeli = $periode->pembelian->sum('total_tonase');
        $totaltonase = $periode->penjualan->sum('tonase_jual');
        $totaljual = $periode->penjualan->sum('total_jual');
        $totalbiaya = $periode->biaya->sum('jumlah_biaya');
        $sisaProduksi = $tonasebeli - $totaltonase;
        $sortir = $sisaProduksi - $periode->sisa->sum('tonase_sisa_terjual');
        return view('produksi.penjualan.produksi', compact(
            'periode',
            'edit',
            'delete',
            'tonasebeli',
            'totaltonase',
            'totaljual',
            'totalbiaya',
            'sisaProduksi',
            'sortir'
        ));
    }

    public function storeProduksi(Request $request)
    {
        Penjualan::create([
            'nama_penjual'      => $request->nama_penjual,
            'harga_jual'        => $request->harga_jual,
            'tonase_jual'       => $request->tonase_jual,
            'total_jual'        => $request->harga_jual * $request->tonase_jual,
            'periode_id'        => $request->periode_id,
            'datausaha_id'      => $request->datausaha_id
        ]);

        Alert::success('Selamat', 'Tambah penjualan produksi berhasil');
        return back();
    }

    public function updateProduksi(Request $request, $id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->update([
            'nama_penjual'      => $request->nama_penjual,
            'harga_jual'        => $request->harga_jual,
            'tonase_jual'       => $request->tonase_jual,
            'total_jual'        => $request->harga_jual * $request->tonase_jual,
        ]);

        Alert::warning('Selamat', 'Edit penjualan produksi berhasil');
        return back();
    }
    public function destroyProduksi($id)
    {
        Penjualan::findOrFail($id)->delete();

        Alert::error('Selamat', 'Hapus penjualan produksi berhasil');
        return back();
    }


    public function storeBiaya(Request $request)
    {
        Biaya::create([
            'title_biaya'       => $request->title_biaya,
            'jumlah_biaya'      => $request->jumlah_biaya,
            'periode_id'        => $request->periode_id,
            'datausaha_id'      => $request->datausaha_id
        ]);

        Alert::success('Selamat', 'Tambah biaya produksi berhasil');
        return back();
    }

    public function updateBiaya(Request $request, $id)
    {
        $biaya = Biaya::findOrFail($id);
        $biaya->update([
            'title_biaya'       => $request->title_biaya,
            'jumlah_biaya'      => $request->jumlah_biaya,
        ]);

        Alert::warning('Selamat', 'Edit biaya berhasil');
        return back();
    }

    public function destroyBiaya($id)
    {
        Biaya::find($id)->delete();

        Alert::error('Selamat', 'Hapus biaya berhasil');
        return back();
    }



    public function storeGaji(Request $request)
    {
        Gaji::create([
            'gaji'              => $request->gaji,
            'periode_id'        => $request->periode_id,
            'datausaha_id'      => $request->datausaha_id
        ]);

        Alert::success('Selamat', 'Tambah gaji produksi berhasil');
        return back();
    }

    public function destroyGaji($id)
    {
        Gaji::find($id)->delete();

        Alert::error('Selamat', 'Hapus gaji berhasil');
        return back();
    }


    public function storeSisa(Request $request)
    {
        Sisaproduksi::create([
            'tonase_sisa_terjual'   => $request->tonase_sisa_terjual,
            'harga'                 => $request->harga,
            'total_sisa_terjual'    => $request->tonase_sisa_terjual * $request->harga,
            'periode_id'            => $request->periode_id,
            'datausaha_id'          => $request->datausaha_id
        ]);

        Alert::success('Selamat', 'Tambah sortir produksi berhasil');
        return back();
    }

    public function destroySisa($id)
    {
        Sisaproduksi::find($id)->delete();

        Alert::error('Selamat', 'Hapus sisa produksi berhasil');
        return back();
    }
}