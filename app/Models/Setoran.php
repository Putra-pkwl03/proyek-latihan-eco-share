<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Setoran extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model (opsional jika nama tabelnya 'setorans').
     *
     * @var string
     */
    protected $table = 'setorans';

    /**
     * Atribut yang dapat diisi secara massal (mass assignment).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'jenis_limbah',
        'berat',
        'poin_didapat',
        'status',
        'tanggal_setor',
    ];

    /**
     * Menentukan tipe data untuk kolom tertentu (casting).
     * Ini memastikan berat selalu bertipe float/double dan tanggal berupa objek Carbon/Date.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'berat' => 'double',
        'poin_didapat' => 'integer',
        'tanggal_setor' => 'date',
    ];

    /**
     * Hubungan Relasi: Setiap setoran dimiliki oleh satu Petani (User).
     * * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}