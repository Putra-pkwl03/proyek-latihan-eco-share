<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokBiomassa extends Model
{
    protected $table = 'stok_biomassas'; // Pastikan nama tabelnya sama persis dengan yang di database
    protected $fillable = ['jenis_limbah', 'total_berat'];
}