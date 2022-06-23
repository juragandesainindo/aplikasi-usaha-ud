<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // protected $dates = ['tanggal_awal', 'tanggal_akhir'];

    public function datausaha()
    {
        return $this->belongsTo(Datausaha::class);
    }

    public function pembelian()
    {
        return $this->hasMany(Pembelian::class);
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class);
    }

    public function biaya()
    {
        return $this->hasMany(Biaya::class);
    }

    public function gaji()
    {
        return $this->hasMany(Gaji::class);
    }

    public function sisa()
    {
        return $this->hasMany(Sisaproduksi::class);
    }
}