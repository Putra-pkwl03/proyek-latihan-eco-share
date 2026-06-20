<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribusi extends Model
{
    protected $fillable = ['nama_industri', 'jenis_biomassa', 'jumlah_kirim', 'tanggal_kirim'];
}
