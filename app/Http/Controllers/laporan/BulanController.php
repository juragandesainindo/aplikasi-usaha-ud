<?php

namespace App\Http\Controllers\laporan;

use App\Http\Controllers\Controller;
use App\Models\Datausaha;
use App\Models\Periode;
// use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class BulanController extends Controller
{

    public function index()
    {
        $usaha = Datausaha::all();

        return view('laporan.bulanan.index', compact('usaha'));
    }

    public function show(Request $request, $id)
    {
        $bln = $request->input('month');
        $thn = $request->input('year');

        $month = $request->input('month');
        $year   = $request->input('year');
        $usahaId = $request->input('usahaId');


        $usaha = Datausaha::find($id);

        $periode = Periode::select()
            ->where('datausaha_id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', $month)
            ->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseBeli = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', $month)
            ->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseJual = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(tonase_jual) as tonase_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', $month)->whereYear('tanggal_awal', '=', $year)
            ->get();

        $totalBeli = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_biaya) as total_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', $month)->whereYear('tanggal_awal', '=', $year)
            ->get();

        $totalJual = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(total_jual) as total_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', $month)->whereYear('tanggal_awal', '=', $year)
            ->get();

        $biaya = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
            ->select([
                DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', $month)->whereYear('tanggal_awal', '=', $year)
            ->get();

        $gaji = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(gaji) as upah'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', $month)->whereYear('tanggal_awal', '=', $year)
            ->get();

        $sisaJual = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', $month)->whereYear('tanggal_awal', '=', $year)
            ->get();


        return view('laporan.bulanan.show', compact(
            'usaha',
            'bln',
            'thn',
            'periode',
            'tonaseBeli',
            'tonaseJual',
            'totalBeli',
            'totalJual',
            'biaya',
            'gaji',
            'sisaJual'
        ));
    }

    public function search(Request $request)
    {
        // $month = $request->input('month');
        // $year   = $request->input('year');
        // $usahaId = $request->input('usahaId');


        // $periode = Periode::select()
        //     ->where('datausaha_id', '=', $usahaId)
        //     ->whereMonth('tanggal_awal', '=', $month)
        //     ->whereYear('tanggal_awal', '=', $year)
        //     ->get();

        // $tonaseBeli = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
        //     ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
        //     ->select([
        //         DB::raw('sum(total_tonase) as tonase_beli'),
        //         DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
        //         DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
        //     ])
        //     ->groupBy(['bulan', 'tahun'])
        //     ->where('datausahas.id', '=', $usahaId)
        //     ->whereMonth('tanggal_awal', '=', $month)
        //     ->whereYear('tanggal_awal', '=', $year)
        //     ->get();
        // //     ->toArray();
        // // dd($tonaseBeli);

        // $tonaseJual = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
        //     ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
        //     ->select([
        //         DB::raw('sum(tonase_jual) as tonase_jual'),
        //         DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
        //         DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
        //     ])
        //     ->groupBy(['bulan', 'tahun'])
        //     ->where('datausahas.id', '=', $usahaId)
        //     ->whereMonth('tanggal_awal', '=', $month)->whereYear('tanggal_awal', '=', $year)
        //     ->get();

        // $totalBeli = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
        //     ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
        //     ->select([
        //         DB::raw('sum(total_biaya) as total_biaya'),
        //         DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
        //         DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
        //     ])
        //     ->groupBy(['bulan', 'tahun'])
        //     ->where('datausahas.id', '=', $usahaId)
        //     ->whereMonth('tanggal_awal', '=', $month)->whereYear('tanggal_awal', '=', $year)
        //     ->get();

        // $totalJual = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
        //     ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
        //     ->select([
        //         DB::raw('sum(total_jual) as total_jual'),
        //         DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
        //         DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
        //     ])
        //     ->groupBy(['bulan', 'tahun'])
        //     ->where('datausahas.id', '=', $usahaId)
        //     ->whereMonth('tanggal_awal', '=', $month)->whereYear('tanggal_awal', '=', $year)
        //     ->get();

        // $biaya = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
        //     ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
        //     ->select([
        //         DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
        //         DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
        //         DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
        //     ])
        //     ->groupBy(['bulan', 'tahun'])
        //     ->where('datausahas.id', '=', $usahaId)
        //     ->whereMonth('tanggal_awal', '=', $month)->whereYear('tanggal_awal', '=', $year)
        //     ->get();

        // $gaji = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
        //     ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
        //     ->select([
        //         DB::raw('sum(gaji) as upah'),
        //         DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
        //         DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
        //     ])
        //     ->groupBy(['bulan', 'tahun'])
        //     ->where('datausahas.id', '=', $usahaId)
        //     ->whereMonth('tanggal_awal', '=', $month)->whereYear('tanggal_awal', '=', $year)
        //     ->get();

        // $sisaJual = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
        //     ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
        //     ->select([
        //         DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
        //         DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
        //         DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
        //     ])
        //     ->groupBy(['bulan', 'tahun'])
        //     ->where('datausahas.id', '=', $usahaId)
        //     ->whereMonth('tanggal_awal', '=', $month)->whereYear('tanggal_awal', '=', $year)
        //     ->get();



        // return view('laporan.bulanan.search', compact(
        //     'periode',
        //     'tonaseBeli',
        //     'tonaseJual',
        //     'totalBeli',
        //     'totalJual',
        //     'biaya',
        //     'gaji',
        //     'sisaJual'
        // ));
    }

    // public function cetak(Request $request)
    // {
    //     $month = $request->input('month');
    //     $year   = $request->input('year');
    //     $periode = Periode::select()->whereMonth('tanggal_awal', '=', $month)->whereYear('tanggal_awal', '=', $year)->get();
    //     $cetak = PDF::loadview('laporan.bulanan.cetak', compact(
    //         'periode',
    //     ));
    //     return $cetak->download('laporan-bulanan.pdf');
    // }

    public function cetak(Request $request, $id)
    {
        $bln = $request->input('month');
        $thn = $request->input('year');

        $month = $request->input('month');
        $year   = $request->input('year');
        $usahaId = $request->input('usahaId');

        $usaha = Datausaha::find($id);

        $periode = Periode::select()
            ->where('datausaha_id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', $month)
            ->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseBeli = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', $month)
            ->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseJual = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(tonase_jual) as tonase_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', $month)->whereYear('tanggal_awal', '=', $year)
            ->get();

        $totalBeli = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_biaya) as total_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', $month)->whereYear('tanggal_awal', '=', $year)
            ->get();

        $totalJual = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(total_jual) as total_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', $month)->whereYear('tanggal_awal', '=', $year)
            ->get();

        $biaya = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
            ->select([
                DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', $month)->whereYear('tanggal_awal', '=', $year)
            ->get();

        $gaji = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(gaji) as upah'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', $month)->whereYear('tanggal_awal', '=', $year)
            ->get();

        $sisaJual = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', $month)->whereYear('tanggal_awal', '=', $year)
            ->get();

        $cetak = PDF::loadview('laporan.bulanan.cetak', compact(
            'usaha',
            'periode',
            'bln',
            'thn',
            'tonaseBeli',
            'tonaseJual',
            'totalBeli',
            'totalJual',
            'biaya',
            'gaji',
            'sisaJual'
        ))->setPaper('a4', 'landscape');
        return $cetak->stream('laporan bulanan');
    }
}