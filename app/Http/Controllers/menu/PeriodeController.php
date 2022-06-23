<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use App\Models\Datausaha;
use App\Models\Periode;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index()
    {
        $usaha = Datausaha::all();
        return view('menu.periode.index', compact('usaha'));
    }

    public function show($id, $slug)
    {
        $usaha = Datausaha::where(['id' => $id, 'slug' => $slug])->first();
        $edit = 1;
        $delete = 1;
        return view('menu.periode.show', compact('usaha', 'edit', 'delete'));
    }

    public function store(Request $request)
    {
        Periode::create([
            'keterangan'    => $request->keterangan,
            'tanggal_awal'  => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'slug'          => Str::slug($request->keterangan, '-'),
            'datausaha_id'  => $request->datausaha_id,
        ]);

        Alert::success('Selamat', 'Tambah periode berhasil');
        return back();
    }

    public function update(Request $request, $id)
    {
        $periode = Periode::findOrFail($id);
        $periode->update([
            'keterangan'    => $request->keterangan,
            'tanggal_awal'  => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'slug'          => Str::slug($request->keterangan, '-'),
        ]);

        Alert::warning('Selamat', 'Edit periode berhasil');
        return back();
    }

    public function destroy($id)
    {
        Periode::find($id)->delete();

        Alert::error('Selamat', 'Hapus periode berhasil');
        return back();
    }
}