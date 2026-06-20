<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('stok_biomassas', function (Blueprint $table) {
        $table->id();
        $table->string('jenis_limbah'); // Contoh: 'kelapa sawit' atau 'sekam padi'
        $table->double('total_berat', 15, 2 );  // Saldo saat ini dalam Kg
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_biomassas');
    }
};
