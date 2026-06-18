<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setoran;
use Illuminate\Http\Request;

class ValidasiSetoranController extends Controller
{
    // 1. Menampilkan semua daftar antrean setoran limbah dari petani
    public function index()
    {
        // Mengambil semua setoran beserta data petani (user) yang mengajukannya
        $daftarSetoran = Setoran::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.validasi-setoran', compact('daftarSetoran'));
    }

    // 2. Proses Validasi (Approved / Rejected) oleh Admin
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected'
        ]);

        $setoran = Setoran::findOrFail($id);
        
        // Cegah manipulasi jika statusnya sudah tidak pending lagi
        if ($setoran->status !== 'pending') {
            return redirect()->back()->with('error', 'Setoran ini sudah divalidasi sebelumnya!');
        }

        $setoran->status = $request->status;

        // JIKA DISETUJUI -> Jalankan Formula Otomatis (1 Kg = 10 Poin)
        if ($request->status === 'approved') {
            $setoran->poin_didapat = $setoran->berat * 10;
        } else {
            $setoran->poin_didapat = 0;
        }

        $setoran->save();

        return redirect()->back()->with('success', 'Status setoran berhasil diperbarui!');
    }
}