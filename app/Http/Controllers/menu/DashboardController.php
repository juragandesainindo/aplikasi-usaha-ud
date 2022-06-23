<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use App\Models\Biaya;
use App\Models\Datausaha;
use App\Models\Gaji;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\Periode;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $usaha = Datausaha::count();
        $periode = Periode::count();
        $tonaseBeli = Pembelian::sum('total_tonase');
        $pembelian = Pembelian::sum('total_biaya');
        $tonaseJual = Penjualan::sum('tonase_jual');
        $penjualan = Penjualan::sum('total_jual');
        $biaya = Biaya::sum('jumlah_biaya');
        $gaji = Gaji::sum('gaji');
        // dd($penjualan);
        return view('menu.dashboard.index', compact('usaha', 'periode', 'tonaseBeli', 'pembelian', 'tonaseJual', 'penjualan', 'biaya', 'gaji'));
    }
}