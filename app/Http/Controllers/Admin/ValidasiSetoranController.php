<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setoran;
use App\Models\StokBiomassa;
use Illuminate\Http\Request;

class ValidasiSetoranController extends Controller
{
    public function index()
    {
        $setorans = Setoran::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.validasi.index', compact('setorans'));
    }

public function updateStatus(Request $request, $id) 
{
    $request->validate(['status' => 'required|in:approved,rejected']);
    $setoran = Setoran::findOrFail($id);

    // DEBUGGING: Cek data apa yang sedang diproses
    // dd($setoran->jenis_limbah, $setoran->berat); 

    if ($setoran->status === $request->status) {
        return back()->with('info', 'Status tidak berubah.');
    }

    // PAKSA STRING JADI LOWERCASE agar cocok dengan database
    $jenisLimbah = strtolower(trim($setoran->jenis_limbah));

    $stok = StokBiomassa::firstOrCreate(
        ['jenis_limbah' => $jenisLimbah], // Pastikan ini lowercase
        ['total_berat' => 0]
    );

    if ($request->status === 'approved') {
        $stok->total_berat += $setoran->berat;
    } elseif ($request->status === 'rejected' && $setoran->status === 'approved') {
        $stok->total_berat -= $setoran->berat;
    }

    $stok->save();
    $setoran->update(['status' => $request->status]);

    return back()->with('success', 'Status & Stok berhasil disinkronkan!');
}

}