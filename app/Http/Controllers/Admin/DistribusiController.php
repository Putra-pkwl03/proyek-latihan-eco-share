<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Distribusi;
use App\Models\StokBiomassa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistribusiController extends Controller
{
    public function index()
    {
        $distribusis = Distribusi::orderBy('tanggal_kirim', 'desc')->get();
    
    // Pastikan data stok selalu ada di database agar tidak 0 terus
        $stokSawit = StokBiomassa::firstOrCreate(['jenis_limbah' => 'kelapa sawit'], ['total_berat' => 0])->total_berat;
        $stokPadi = StokBiomassa::firstOrCreate(['jenis_limbah' => 'sekam padi'], ['total_berat' => 0])->total_berat;

        return view('admin.distribusi.index', compact('distribusis', 'stokSawit', 'stokPadi'));
    }

public function store(Request $request)
{
    $request->validate([
        'nama_industri' => 'required|string',
        'jenis_biomassa' => 'required|in:kelapa sawit,sekam padi',
        'jumlah_kirim' => 'required|numeric|min:1',
        'tanggal_kirim' => 'required|date',
    ]);

    DB::beginTransaction();

    try {
        // PERBAIKAN: Gunakan strtolower untuk memastikan case-insensitive
        $jenis = strtolower(trim($request->jenis_biomassa));
        
        $stok = StokBiomassa::where('jenis_limbah', $jenis)->lockForUpdate()->first();

        if (!$stok || $request->jumlah_kirim > $stok->total_berat) {
            return back()->with('error', 'Gagal! Stok tidak mencukupi atau tidak tersedia.');
        }

        // Simpan log distribusi dengan data yang sudah di-trim/lower
        Distribusi::create([
            'nama_industri'  => $request->nama_industri,
            'jenis_biomassa' => $jenis,
            'jumlah_kirim'   => $request->jumlah_kirim,
            'tanggal_kirim'  => $request->tanggal_kirim,
        ]);

        // Kurangi stok
        $stok->total_berat -= $request->jumlah_kirim;
        $stok->save();

        DB::commit();
        return redirect()->route('admin.distribusi.index')->with('success', 'Distribusi berhasil!');
        
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $distribusi = Distribusi::findOrFail($id);
            
            // Kembalikan stok saat distribusi dibatalkan
            $stok = StokBiomassa::where('jenis_limbah', $distribusi->jenis_biomassa)->first();
            if ($stok) {
                $stok->total_berat += $distribusi->jumlah_kirim;
                $stok->save();
            }

            $distribusi->delete();
            DB::commit();
            
            return redirect()->route('admin.distribusi.index')->with('success', 'Log distribusi dibatalkan & stok dikembalikan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal membatalkan data.');
        }
    }
}