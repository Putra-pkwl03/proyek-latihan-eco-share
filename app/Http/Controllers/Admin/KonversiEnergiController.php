<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KonversiEnergi;
use App\Models\Distribusi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KonversiEnergiController extends Controller
{
    public function index()
    {
        // Menggunakan latest() untuk menampilkan yang terbaru
        $konversi = KonversiEnergi::with('distribusi')->latest()->get();
        return view('admin.energi.index', compact('konversi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'distribusi_id' => 'required|exists:distribusis,id|unique:konversi_energis,distribusi_id',
            'total_kwh' => 'required|numeric|min:0',
        ], [
            'distribusi_id.unique' => 'Log distribusi ini sudah dikonversi sebelumnya.',
        ]);

        try {
            DB::beginTransaction();

            // Simpan data
            KonversiEnergi::create([
                'distribusi_id' => $request->distribusi_id,
                'total_kwh'     => $request->total_kwh,
            ]);

            DB::commit();
            return back()->with('success', 'Data distribusi energi berhasil dicatat!');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}