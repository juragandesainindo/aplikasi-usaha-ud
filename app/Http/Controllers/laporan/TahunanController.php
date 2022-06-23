<?php

namespace App\Http\Controllers\laporan;

use App\Http\Controllers\Controller;
use App\Models\Datausaha;
use App\Models\Periode;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TahunanController extends Controller
{
    public function index()
    {
        $usaha = Datausaha::all();
        return view('laporan.tahunan.index', compact('usaha'));
    }

    public function show(Request $request, $id)
    {
        $tahun = $request->input('year');
        // dd($tahun);
        $usaha = Datausaha::findOrFail($id);

        $year   = $request->input('year');
        $usahaId = $request->input('usahaId');

        $periode = Periode::select()
            ->where('datausaha_id', '=', $usahaId)
            ->whereYear('tanggal_awal', '=', $year)
            ->get();

        // ############################# JANUARI START #############################
        $tonaseBeliJan = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '01')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseJualJan = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(tonase_jual) as tonase_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '01')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalBeliJan = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_biaya) as total_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '01')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalJualJan = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(total_jual) as total_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '01')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $biayaJan = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
            ->select([
                DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '01')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $gajiJan = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
            ->select([
                DB::raw('sum(gaji) as upah'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '01')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $sisaJualJan = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '01')->whereYear('tanggal_awal', '=', $year)
            ->get();
        // ############################# JANUARI END #############################

        // ############################# FEBRUARI START #############################
        $tonaseBeliFeb = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '02')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseJualFeb = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(tonase_jual) as tonase_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '02')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalBeliFeb = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_biaya) as total_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '02')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalJualFeb = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(total_jual) as total_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '02')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $biayaFeb = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
            ->select([
                DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '02')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $gajiFeb = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
            ->select([
                DB::raw('sum(gaji) as upah'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '02')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $sisaJualFeb = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '02')->whereYear('tanggal_awal', '=', $year)
            ->get();
        // ############################# FEBRUARI END #############################

        // ############################# MARET START #############################
        $tonaseBeliMar = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '03')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseJualMar = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(tonase_jual) as tonase_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '03')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalBeliMar = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_biaya) as total_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '03')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalJualMar = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(total_jual) as total_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '03')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $biayaMar = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
            ->select([
                DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '03')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $gajiMar = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
            ->select([
                DB::raw('sum(gaji) as upah'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '03')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $sisaJualMar = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '03')->whereYear('tanggal_awal', '=', $year)
            ->get();
        // ############################# MARET END #############################

        // ############################# APRIL START #############################
        $tonaseBeliApr = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '04')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseJualApr = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(tonase_jual) as tonase_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '04')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalBeliApr = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_biaya) as total_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '04')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalJualApr = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(total_jual) as total_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '04')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $biayaApr = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
            ->select([
                DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '04')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $gajiApr = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
            ->select([
                DB::raw('sum(gaji) as upah'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '04')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $sisaJualApr = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '04')->whereYear('tanggal_awal', '=', $year)
            ->get();
        // ############################# APRIL END #############################

        // ############################# MEI START #############################
        $tonaseBeliMei = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '05')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseJualMei = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(tonase_jual) as tonase_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '05')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalBeliMei = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_biaya) as total_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '05')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalJualMei = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(total_jual) as total_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '05')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $biayaMei = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
            ->select([
                DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '05')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $gajiMei = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
            ->select([
                DB::raw('sum(gaji) as upah'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '05')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $sisaJualMei = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '05')->whereYear('tanggal_awal', '=', $year)
            ->get();
        // ############################# MEI END #############################

        // ############################# JUNI START #############################
        $tonaseBeliJun = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '06')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseJualJun = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(tonase_jual) as tonase_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '06')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalBeliJun = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_biaya) as total_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '06')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalJualJun = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(total_jual) as total_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '06')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $biayaJun = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
            ->select([
                DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '06')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $gajiJun = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
            ->select([
                DB::raw('sum(gaji) as upah'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '06')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $sisaJualJun = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '06')->whereYear('tanggal_awal', '=', $year)
            ->get();
        // ############################# JUNI END #############################

        // ############################# JULI START #############################
        $tonaseBeliJul = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '07')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseJualJul = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(tonase_jual) as tonase_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '07')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalBeliJul = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_biaya) as total_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '07')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalJualJul = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(total_jual) as total_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '07')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $biayaJul = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
            ->select([
                DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '07')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $gajiJul = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
            ->select([
                DB::raw('sum(gaji) as upah'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '07')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $sisaJualJul = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '07')->whereYear('tanggal_awal', '=', $year)
            ->get();
        // ############################# JULI END #############################

        // ############################# AGUSTUS START #############################
        $tonaseBeliAug = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '08')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseJualAug = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(tonase_jual) as tonase_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '08')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalBeliAug = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_biaya) as total_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '08')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalJualAug = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(total_jual) as total_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '08')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $biayaAug = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
            ->select([
                DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '08')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $gajiAug = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
            ->select([
                DB::raw('sum(gaji) as upah'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '08')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $sisaJualAug = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '08')->whereYear('tanggal_awal', '=', $year)
            ->get();
        // ############################# AGUSTUS END #############################

        // ############################# SEPTEMBER START #############################
        $tonaseBeliSep = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '09')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseJualSep = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(tonase_jual) as tonase_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '09')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalBeliSep = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_biaya) as total_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '09')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalJualSep = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(total_jual) as total_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '09')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $biayaSep = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
            ->select([
                DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '09')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $gajiSep = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
            ->select([
                DB::raw('sum(gaji) as upah'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '09')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $sisaJualSep = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '09')->whereYear('tanggal_awal', '=', $year)
            ->get();
        // ############################# SEPTEMBER END #############################

        // ############################# OKTOBER START #############################
        $tonaseBeliOkt = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '10')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseJualOkt = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(tonase_jual) as tonase_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '10')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalBeliOkt = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_biaya) as total_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '10')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalJualOkt = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(total_jual) as total_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '10')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $biayaOkt = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
            ->select([
                DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '10')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $gajiOkt = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
            ->select([
                DB::raw('sum(gaji) as upah'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '10')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $sisaJualOkt = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '10')->whereYear('tanggal_awal', '=', $year)
            ->get();
        // ############################# OKTOBER END #############################

        // ############################# NOVEMBER START #############################
        $tonaseBeliNov = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '11')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseJualNov = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(tonase_jual) as tonase_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '11')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalBeliNov = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_biaya) as total_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '11')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalJualNov = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(total_jual) as total_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '11')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $biayaNov = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
            ->select([
                DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '11')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $gajiNov = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
            ->select([
                DB::raw('sum(gaji) as upah'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '11')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $sisaJualNov = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '11')->whereYear('tanggal_awal', '=', $year)
            ->get();
        // ############################# NOVEMBER END #############################

        // ############################# DESEMBER START #############################
        $tonaseBeliDes = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '12')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseJualDes = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(tonase_jual) as tonase_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '12')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalBeliDes = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_biaya) as total_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '12')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalJualDes = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(total_jual) as total_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '12')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $biayaDes = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
            ->select([
                DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '12')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $gajiDes = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
            ->select([
                DB::raw('sum(gaji) as upah'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '12')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $sisaJualDes = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '12')->whereYear('tanggal_awal', '=', $year)
            ->get();
        // ############################# DESEMBER END #############################



        return view('laporan.tahunan.show', compact(
            'usaha',
            'periode',
            'tahun',
            'tonaseBeliJan',
            'tonaseJualJan',
            'totalBeliJan',
            'totalJualJan',
            'biayaJan',
            'gajiJan',
            'sisaJualJan',

            'tonaseBeliFeb',
            'tonaseJualFeb',
            'totalBeliFeb',
            'totalJualFeb',
            'biayaFeb',
            'gajiFeb',
            'sisaJualFeb',

            'tonaseBeliMar',
            'tonaseJualMar',
            'totalBeliMar',
            'totalJualMar',
            'biayaMar',
            'gajiMar',
            'sisaJualMar',

            'tonaseBeliApr',
            'tonaseJualApr',
            'totalBeliApr',
            'totalJualApr',
            'biayaApr',
            'gajiApr',
            'sisaJualApr',

            'tonaseBeliMei',
            'tonaseJualMei',
            'totalBeliMei',
            'totalJualMei',
            'biayaMei',
            'gajiMei',
            'sisaJualMei',

            'tonaseBeliJun',
            'tonaseJualJun',
            'totalBeliJun',
            'totalJualJun',
            'biayaJun',
            'gajiJun',
            'sisaJualJun',

            'tonaseBeliJul',
            'tonaseJualJul',
            'totalBeliJul',
            'totalJualJul',
            'biayaJul',
            'gajiJul',
            'sisaJualJul',

            'tonaseBeliAug',
            'tonaseJualAug',
            'totalBeliAug',
            'totalJualAug',
            'biayaAug',
            'gajiAug',
            'sisaJualAug',

            'tonaseBeliSep',
            'tonaseJualSep',
            'totalBeliSep',
            'totalJualSep',
            'biayaSep',
            'gajiSep',
            'sisaJualSep',

            'tonaseBeliOkt',
            'tonaseJualOkt',
            'totalBeliOkt',
            'totalJualOkt',
            'biayaOkt',
            'gajiOkt',
            'sisaJualOkt',

            'tonaseBeliNov',
            'tonaseJualNov',
            'totalBeliNov',
            'totalJualNov',
            'biayaNov',
            'gajiNov',
            'sisaJualNov',

            'tonaseBeliDes',
            'tonaseJualDes',
            'totalBeliDes',
            'totalJualDes',
            'biayaDes',
            'gajiDes',
            'sisaJualDes',
        ));
    }

    public function cetak(Request $request, $id)
    {
        $tahun = $request->input('year');
        // dd($tahun);
        $usaha = Datausaha::findOrFail($id);

        $year   = $request->input('year');
        $usahaId = $request->input('usahaId');

        $periode = Periode::select()
            ->where('datausaha_id', '=', $usahaId)
            ->whereYear('tanggal_awal', '=', $year)
            ->get();

        // ############################# JANUARI START #############################
        $tonaseBeliJan = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '01')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseJualJan = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(tonase_jual) as tonase_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '01')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalBeliJan = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_biaya) as total_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '01')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalJualJan = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(total_jual) as total_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '01')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $biayaJan = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
            ->select([
                DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '01')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $gajiJan = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
            ->select([
                DB::raw('sum(gaji) as upah'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '01')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $sisaJualJan = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '01')->whereYear('tanggal_awal', '=', $year)
            ->get();
        // ############################# JANUARI END #############################

        // ############################# FEBRUARI START #############################
        $tonaseBeliFeb = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '02')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseJualFeb = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(tonase_jual) as tonase_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '02')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalBeliFeb = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_biaya) as total_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '02')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalJualFeb = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(total_jual) as total_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '02')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $biayaFeb = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
            ->select([
                DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '02')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $gajiFeb = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
            ->select([
                DB::raw('sum(gaji) as upah'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '02')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $sisaJualFeb = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '02')->whereYear('tanggal_awal', '=', $year)
            ->get();
        // ############################# FEBRUARI END #############################

        // ############################# MARET START #############################
        $tonaseBeliMar = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '03')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseJualMar = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(tonase_jual) as tonase_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '03')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalBeliMar = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_biaya) as total_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '03')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalJualMar = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(total_jual) as total_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '03')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $biayaMar = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
            ->select([
                DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '03')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $gajiMar = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
            ->select([
                DB::raw('sum(gaji) as upah'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '03')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $sisaJualMar = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '03')->whereYear('tanggal_awal', '=', $year)
            ->get();
        // ############################# MARET END #############################

        // ############################# APRIL START #############################
        $tonaseBeliApr = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '04')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseJualApr = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(tonase_jual) as tonase_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '04')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalBeliApr = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_biaya) as total_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '04')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalJualApr = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(total_jual) as total_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '04')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $biayaApr = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
            ->select([
                DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '04')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $gajiApr = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
            ->select([
                DB::raw('sum(gaji) as upah'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '04')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $sisaJualApr = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '04')->whereYear('tanggal_awal', '=', $year)
            ->get();
        // ############################# APRIL END #############################

        // ############################# MEI START #############################
        $tonaseBeliMei = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '05')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseJualMei = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(tonase_jual) as tonase_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '05')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalBeliMei = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_biaya) as total_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '05')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalJualMei = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(total_jual) as total_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '05')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $biayaMei = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
            ->select([
                DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '05')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $gajiMei = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
            ->select([
                DB::raw('sum(gaji) as upah'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '05')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $sisaJualMei = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '05')->whereYear('tanggal_awal', '=', $year)
            ->get();
        // ############################# MEI END #############################

        // ############################# JUNI START #############################
        $tonaseBeliJun = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '06')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseJualJun = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(tonase_jual) as tonase_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '06')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalBeliJun = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_biaya) as total_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '06')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalJualJun = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(total_jual) as total_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '06')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $biayaJun = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
            ->select([
                DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '06')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $gajiJun = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
            ->select([
                DB::raw('sum(gaji) as upah'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '06')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $sisaJualJun = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '06')->whereYear('tanggal_awal', '=', $year)
            ->get();
        // ############################# JUNI END #############################

        // ############################# JULI START #############################
        $tonaseBeliJul = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '07')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseJualJul = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(tonase_jual) as tonase_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '07')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalBeliJul = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_biaya) as total_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '07')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalJualJul = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(total_jual) as total_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '07')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $biayaJul = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
            ->select([
                DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '07')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $gajiJul = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
            ->select([
                DB::raw('sum(gaji) as upah'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '07')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $sisaJualJul = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '07')->whereYear('tanggal_awal', '=', $year)
            ->get();
        // ############################# JULI END #############################

        // ############################# AGUSTUS START #############################
        $tonaseBeliAug = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '08')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseJualAug = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(tonase_jual) as tonase_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '08')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalBeliAug = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_biaya) as total_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '08')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalJualAug = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(total_jual) as total_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '08')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $biayaAug = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
            ->select([
                DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '08')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $gajiAug = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
            ->select([
                DB::raw('sum(gaji) as upah'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '08')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $sisaJualAug = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '08')->whereYear('tanggal_awal', '=', $year)
            ->get();
        // ############################# AGUSTUS END #############################

        // ############################# SEPTEMBER START #############################
        $tonaseBeliSep = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '09')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseJualSep = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(tonase_jual) as tonase_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '09')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalBeliSep = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_biaya) as total_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '09')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalJualSep = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(total_jual) as total_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '09')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $biayaSep = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
            ->select([
                DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '09')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $gajiSep = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
            ->select([
                DB::raw('sum(gaji) as upah'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '09')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $sisaJualSep = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '09')->whereYear('tanggal_awal', '=', $year)
            ->get();
        // ############################# SEPTEMBER END #############################

        // ############################# OKTOBER START #############################
        $tonaseBeliOkt = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '10')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseJualOkt = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(tonase_jual) as tonase_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '10')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalBeliOkt = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_biaya) as total_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '10')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalJualOkt = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(total_jual) as total_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '10')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $biayaOkt = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
            ->select([
                DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '10')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $gajiOkt = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
            ->select([
                DB::raw('sum(gaji) as upah'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '10')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $sisaJualOkt = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '10')->whereYear('tanggal_awal', '=', $year)
            ->get();
        // ############################# OKTOBER END #############################

        // ############################# NOVEMBER START #############################
        $tonaseBeliNov = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '11')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseJualNov = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(tonase_jual) as tonase_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '11')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalBeliNov = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_biaya) as total_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '11')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalJualNov = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(total_jual) as total_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '11')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $biayaNov = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
            ->select([
                DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '11')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $gajiNov = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
            ->select([
                DB::raw('sum(gaji) as upah'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '11')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $sisaJualNov = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '11')->whereYear('tanggal_awal', '=', $year)
            ->get();
        // ############################# NOVEMBER END #############################

        // ############################# DESEMBER START #############################
        $tonaseBeliDes = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '12')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $tonaseJualDes = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(tonase_jual) as tonase_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '12')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalBeliDes = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_biaya) as total_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '12')->whereYear('tanggal_awal', '=', $year)
            ->get();
        $totalJualDes = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('penjualans', 'periodes.id', '=', 'penjualans.periode_id')
            ->select([
                DB::raw('sum(total_jual) as total_jual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '12')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $biayaDes = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('biayas', 'periodes.id', '=', 'biayas.periode_id')
            ->select([
                DB::raw('sum(jumlah_biaya) as jumlah_biaya'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '12')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $gajiDes = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('gajis', 'periodes.id', '=', 'gajis.periode_id')
            ->select([
                DB::raw('sum(gaji) as upah'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '12')->whereYear('tanggal_awal', '=', $year)
            ->get();

        $sisaJualDes = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('sisaproduksis', 'periodes.id', '=', 'sisaproduksis.periode_id')
            ->select([
                DB::raw('sum(tonase_sisa_terjual) as tonase_sisa_terjual'),
                DB::raw('EXTRACT(MONTH from tanggal_awal) as bulan'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy(['bulan', 'tahun'])
            ->where('datausahas.id', '=', $usahaId)
            ->whereMonth('tanggal_awal', '=', '12')->whereYear('tanggal_awal', '=', $year)
            ->get();
        // ############################# DESEMBER END #############################





        $cetak = Pdf::loadview('laporan.tahunan.cetak', compact(
            'usaha',
            'periode',
            'tahun',
            'tonaseBeliJan',
            'tonaseJualJan',
            'totalBeliJan',
            'totalJualJan',
            'biayaJan',
            'gajiJan',
            'sisaJualJan',

            'tonaseBeliFeb',
            'tonaseJualFeb',
            'totalBeliFeb',
            'totalJualFeb',
            'biayaFeb',
            'gajiFeb',
            'sisaJualFeb',

            'tonaseBeliMar',
            'tonaseJualMar',
            'totalBeliMar',
            'totalJualMar',
            'biayaMar',
            'gajiMar',
            'sisaJualMar',

            'tonaseBeliApr',
            'tonaseJualApr',
            'totalBeliApr',
            'totalJualApr',
            'biayaApr',
            'gajiApr',
            'sisaJualApr',

            'tonaseBeliMei',
            'tonaseJualMei',
            'totalBeliMei',
            'totalJualMei',
            'biayaMei',
            'gajiMei',
            'sisaJualMei',

            'tonaseBeliJun',
            'tonaseJualJun',
            'totalBeliJun',
            'totalJualJun',
            'biayaJun',
            'gajiJun',
            'sisaJualJun',

            'tonaseBeliJul',
            'tonaseJualJul',
            'totalBeliJul',
            'totalJualJul',
            'biayaJul',
            'gajiJul',
            'sisaJualJul',

            'tonaseBeliAug',
            'tonaseJualAug',
            'totalBeliAug',
            'totalJualAug',
            'biayaAug',
            'gajiAug',
            'sisaJualAug',

            'tonaseBeliSep',
            'tonaseJualSep',
            'totalBeliSep',
            'totalJualSep',
            'biayaSep',
            'gajiSep',
            'sisaJualSep',

            'tonaseBeliOkt',
            'tonaseJualOkt',
            'totalBeliOkt',
            'totalJualOkt',
            'biayaOkt',
            'gajiOkt',
            'sisaJualOkt',

            'tonaseBeliNov',
            'tonaseJualNov',
            'totalBeliNov',
            'totalJualNov',
            'biayaNov',
            'gajiNov',
            'sisaJualNov',

            'tonaseBeliDes',
            'tonaseJualDes',
            'totalBeliDes',
            'totalJualDes',
            'biayaDes',
            'gajiDes',
            'sisaJualDes',
        ))->setPaper('a4', 'landscape');
        return $cetak->stream('laporan tahunan');
    }
}