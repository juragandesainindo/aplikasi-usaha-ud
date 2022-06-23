<?php

namespace App\Http\Controllers\laporan;

use App\Http\Controllers\Controller;
use App\Models\Datausaha;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GrandTotalController extends Controller
{
    public function index()
    {
        $usaha = Datausaha::all();
        return view('laporan.grand-total.index', compact('usaha'));
    }

    public function show($id)
    {
        $usaha = Datausaha::find($id);
        $periode = Periode::select()
            ->where('datausaha_id', '=', $usaha->id)
            ->get()->toArray();
        // dd($periode);
        $tonaseBeli = Datausaha::join('periodes', 'datausahas.id', '=', 'periodes.datausaha_id')
            ->join('pembelians', 'periodes.id', '=', 'pembelians.periode_id')
            ->select([
                DB::raw('sum(total_tonase) as tonase_beli'),
                DB::raw('EXTRACT(YEAR from tanggal_awal) as tahun')
            ])
            ->groupBy('tahun')
            ->where('datausahas.id', '=', $usaha->id)
            ->orderBy('tahun', 'DESC')
            // ->whereYear('tanggal_awal')
            ->get();
        // dd($tonaseBeli);
        return view('laporan.grand-total.show', compact('usaha', 'periode', 'tonaseBeli'));
    }
}