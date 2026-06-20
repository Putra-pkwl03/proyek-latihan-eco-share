<?php

namespace App\Http\Controllers\Petani;

use App\Http\Controllers\Controller;
use App\Models\Setoran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetoranLimbahController extends Controller
{
    // READ: Menampilkan Riwayat Setoran (Bukan CRUD)
    public function index()
    {
        // Pastikan path view sesuai dengan struktur folder Anda
        $riwayatPoin = Setoran::where('user_id', Auth::id())->orderBy('tanggal_setor', 'desc')->get();
        return view('petani.setoran.index', compact('riwayatPoin'));
    }

    // CREATE: Menampilkan Form + Tabel Kelola (CRUD)
    public function create()
    {
        $setorans = Setoran::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('petani.setoran.create', compact('setorans'));
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'jenis_limbah' => 'required|in:kelapa sawit,sekam padi',
            'berat' => 'required|numeric|min:1',
            'tanggal_setor' => 'required|date',
        ]);

        Setoran::create([
            'user_id' => Auth::id(),
            'jenis_limbah' => $request->jenis_limbah,
            'berat' => $request->berat,
            'tanggal_setor' => $request->tanggal_setor,
            'poin_didapat' => $request->berat * 10,
            'status' => 'pending',
        ]);

        return redirect()->route('petani.setoran.create')->with('success', 'Setoran berhasil diajukan!');
    }

    // EDIT
    public function edit($id)
    {
        $setoran = Setoran::where('user_id', Auth::id())->findOrFail($id);
        
        if ($setoran->status !== 'pending') {
            return redirect()->route('petani.setoran.create')->with('error', 'Setoran tidak bisa diubah!');
        }

        return view('petani.setoran.edit', compact('setoran'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $setoran = Setoran::where('user_id', Auth::id())->findOrFail($id);

        if ($setoran->status !== 'pending') {
            return redirect()->route('petani.setoran.create')->with('error', 'Setoran tidak bisa diubah!');
        }

        $request->validate([
            'jenis_limbah' => 'required|in:kelapa sawit,sekam padi',
            'berat' => 'required|numeric|min:1',
            'tanggal_setor' => 'required|date',
        ]);

        $setoran->update([
            'jenis_limbah' => $request->jenis_limbah,
            'berat' => $request->berat,
            'tanggal_setor' => $request->tanggal_setor,
            'poin_didapat' => $request->berat * 10,
        ]);

        return redirect()->route('petani.setoran.create')->with('success', 'Data diperbarui!');
    }

    // DESTROY
    public function destroy($id)
    {
        $setoran = Setoran::where('user_id', Auth::id())->findOrFail($id);
// Tambahkan di bawah $setoran = Setoran::findOrFail($id);
dd($setoran->jenis_limbah, $setoran->berat, $request->status);
        if ($setoran->status !== 'pending') {
            return redirect()->route('petani.setoran.create')->with('error', 'Setoran tidak bisa dihapus!');
        }

        $setoran->delete();
        return redirect()->route('petani.setoran.create')->with('success', 'Setoran dibatalkan!');
    }
}