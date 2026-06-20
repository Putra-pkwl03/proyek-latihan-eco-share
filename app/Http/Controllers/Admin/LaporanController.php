<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setoran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil input filter, default ke awal dan akhir bulan ini
        $start = $request->input('start_date', date('Y-m-01'));
        $end = $request->input('end_date', date('Y-m-t'));

        // 2. Ambil data dengan filter tanggal
        $transaksi = Setoran::whereBetween('tanggal_setor', [$start, $end])
                            ->with('user')
                            ->latest()
                            ->get();
 
        // 3. Hitung ringkasan untuk kartu (cards)
        $totalSetoran = $transaksi->where('status', 'approved')->sum('berat');
        $totalDitolak = $transaksi->where('status', 'rejected')->sum('berat');

        return view('admin.laporan.index', compact('transaksi', 'totalSetoran', 'totalDitolak', 'start', 'end'));
    }

    public function cetak(Request $request)
    {
        // Ambil data yang sama untuk dicetak
        $start = $request->input('start_date', date('Y-m-01'));
        $end = $request->input('end_date', date('Y-m-t'));
        
        $transaksi = Setoran::whereBetween('tanggal_setor', [$start, $end])->with('user')->get();
        return view('admin.laporan.cetak', compact('transaksi', 'start', 'end'));
    }



    public function exportPdf(Request $request) {
        $transaksi = Setoran::whereBetween('created_at', [$request->start, $request->end])->get();
        $pdf = Pdf::loadView('admin.laporan.cetak', compact('transaksi'));
        return $pdf->download('laporan-transaksi.pdf');
}
}