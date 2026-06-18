<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DompetController extends Controller
{
    public function index()
    {
        // Mengambil data petani yang sedang login beserta riwayat setorannya yang disetujui/semua riwayat
        $user = Auth::user();
        
        // Ambil riwayat setoran untuk melihat track record poin
        $riwayatPoin = $user->setorans()->orderBy('tanggal_setor', 'desc')->get();
        
        // Hitung total poin aktif (bisa ambil dari kolom users, atau sum manual dari yang approved)
        $totalPoin = $user->setorans()->where('status', 'approved')->sum('poin_didapat');

        return view('petani.dompet', compact('riwayatPoin', 'totalPoin'));
    }
}
