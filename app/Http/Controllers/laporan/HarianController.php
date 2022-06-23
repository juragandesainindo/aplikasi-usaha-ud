<?php

namespace App\Http\Controllers\laporan;

use App\Http\Controllers\Controller;
use App\Models\Datausaha;
use App\Models\Periode;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class HarianController extends Controller
{
    public function index()
    {
        $usaha = Datausaha::all();
        return view('laporan.harian.index', compact('usaha'));
    }

    public function show($id, $slug)
    {
        $usaha = Datausaha::where(['id' => $id, 'slug' => $slug])->first();
        $preview = 1;
        return view('laporan.harian.show', compact('usaha', 'preview'));
    }

    public function preview($id, $slug)
    {
        $periode = Periode::where(['id' => $id, 'slug' => $slug])->first();

        $tonasesuper = $periode->pembelian->sum('tonase_super');
        $tonasebulat = $periode->pembelian->sum('tonase_bulat');
        $tonasesortiran = $periode->pembelian->sum('tonase_sortiran');
        $totalsuper = $periode->pembelian->sum('total_super');
        $totalbulat = $periode->pembelian->sum('total_bulat');
        $totalsortiran = $periode->pembelian->sum('total_sortiran');
        $totalbiaya = $periode->pembelian->sum('total_biaya');
        $totaltonase = $periode->pembelian->sum('total_tonase');
        $grandtotalbeli = $totalbiaya / $totaltonase;

        $tonasejual = $periode->penjualan->sum('tonase_jual');
        $totaljual = $periode->penjualan->sum('total_jual');

        $hargaratarata = $totaljual / $tonasejual;
        $selisihtonase = $tonasejual - $totaltonase;
        $selisihharga = $hargaratarata - $grandtotalbeli;
        $pendapatankotor = $totaljual - $totalbiaya;

        $jumlahbiaya = $periode->biaya->sum('jumlah_biaya');

        $labarugi = $pendapatankotor - $jumlahbiaya;

        return view('laporan.harian.preview', compact(
            'periode',
            'tonasesuper',
            'tonasebulat',
            'tonasesortiran',
            'totalsuper',
            'totalbulat',
            'totalsortiran',
            'totalbiaya',
            'totaltonase',
            'grandtotalbeli',

            'tonasejual',
            'totaljual',

            'hargaratarata',
            'selisihtonase',
            'selisihharga',
            'pendapatankotor',

            'jumlahbiaya',
            'labarugi'
        ));
    }

    public function cetak($id, $slug)
    {
        $periode = Periode::where(['id' => $id, 'slug' => $slug])->first();

        $tonasesuper = $periode->pembelian->sum('tonase_super');
        $tonasebulat = $periode->pembelian->sum('tonase_bulat');
        $tonasesortiran = $periode->pembelian->sum('tonase_sortiran');
        $totalsuper = $periode->pembelian->sum('total_super');
        $totalbulat = $periode->pembelian->sum('total_bulat');
        $totalsortiran = $periode->pembelian->sum('total_sortiran');
        $totalbiaya = $periode->pembelian->sum('total_biaya');
        $totaltonase = $periode->pembelian->sum('total_tonase');
        $grandtotalbeli = $totalbiaya / $totaltonase;

        $tonasejual = $periode->penjualan->sum('tonase_jual');
        $totaljual = $periode->penjualan->sum('total_jual');

        $hargaratarata = $totaljual / $tonasejual;
        $selisihtonase = $tonasejual - $totaltonase;
        $selisihharga = $hargaratarata - $grandtotalbeli;
        $pendapatankotor = $totaljual - $totalbiaya;

        $jumlahbiaya = $periode->biaya->sum('jumlah_biaya');

        $labarugi = $pendapatankotor - $jumlahbiaya;


        $cetak = PDF::loadview('laporan.harian.cetak', compact(
            'periode',
            'tonasesuper',
            'tonasebulat',
            'tonasesortiran',
            'totalsuper',
            'totalbulat',
            'totalsortiran',
            'totalbiaya',
            'totaltonase',
            'grandtotalbeli',

            'tonasejual',
            'totaljual',

            'hargaratarata',
            'selisihtonase',
            'selisihharga',
            'pendapatankotor',

            'jumlahbiaya',
            'labarugi'

        ))->setPaper('a4', 'landscape');
        // return $cetak->download('laporan-harian.pdf');
        return $cetak->stream('laporan harian');
    }
}
