<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function datausaha()
    {
        return $this->belongsTo(Datausaha::class);
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }
    public function usaha()
    {
        return $this->belongsTo(Datausaha::class);
    }
}