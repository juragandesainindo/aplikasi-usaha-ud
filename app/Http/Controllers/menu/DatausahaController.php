<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use App\Models\Datausaha;
use Illuminate\Support\Str;
// use Barryvdh\DomPDF\Facade\Pdf;
// use RealRashid\SweetAlert\Facades\Alert;
use Alert;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert as FacadesAlert;

class DatausahaController extends Controller
{
    public function index()
    {
        $datausaha = Datausaha::all();
        $edit = 1;
        $delete = 1;
        return view('menu.data-usaha.index', compact('datausaha', 'edit', 'delete'));
    }

    public function store(Request $request)
    {
        Datausaha::create([
            'nama_usaha'    => $request->nama_usaha,
            'slug'          => Str::slug($request->nama_usaha, '-'),
        ]);

        FacadesAlert::success('Selamat', 'Tambah data usaha berhasil');
        return back();
    }

    public function update(Request $request, $id)
    {
        $datausaha = Datausaha::findOrfail($id);

        $datausaha->update([
            'nama_usaha'    => $request->nama_usaha,
            'slug'          => Str::slug($request->nama_usaha, '-'),
        ]);

        FacadesAlert::warning('Selamat', 'Ubah data usaha berhasil');
        return back();
    }

    public function destroy($id)
    {
        Datausaha::find($id)->delete();

        FacadesAlert::error('Selamat', 'Hapus data usaha berhasil');
        return back();
    }

    // public function show($slug)
    // {
    //     $datausaha = Datausaha::find($slug);
    //     return view('menu.data-usaha.show', compact('datausaha'));
    // }

    // public function cetak()
    // {
    //     $usaha = Datausaha::all();

    //     $pdf = PDF::loadView('menu.data-usaha.index', compact('usaha'));
    //     return $pdf->download('laporan-harian.pdf');
    // }
}