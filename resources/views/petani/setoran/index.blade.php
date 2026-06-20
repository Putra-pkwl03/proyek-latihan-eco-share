<x-app-layout>
    <div class="p-6 space-y-6">
        
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Riwayat Setoran Limbah</h2>
                <p class="text-xs text-slate-400 mt-0.5">Kecamatan : <span class="text-emerald-600 font-semibold">Prambanan</span></p>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="mb-4">
                <h3 class="text-sm font-bold text-slate-800">Log Pengajuan Setoran Anda</h3>
                <p class="text-[11px] text-slate-400">Daftar rekaman seluruh setoran limbah biomassa Anda beserta status konfirmasinya.</p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-slate-50 text-[10px] text-slate-400 uppercase font-bold tracking-wider border-b border-slate-100">
                        <tr>
                            <th class="p-4">Tanggal Setor</th>
                            <th class="p-4">Jenis Limbah</th>
                            <th class="p-4">Berat (Kg)</th>
                            <th class="p-4">Poin Diperoleh</th>
                            <th class="p-4">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                        @forelse($riwayatPoin ?? [] as $row)
                            <tr class="hover:bg-slate-50/50 transition-colors">
                                <td class="p-4 text-slate-400">{{ \Carbon\Carbon::parse($row->tanggal_setor)->format('d/m/Y') }}</td>
                                <td class="p-4 capitalize font-semibold text-slate-800">{{ $row->jenis_limbah }}</td>
                                <td class="p-4 text-slate-700 font-medium">{{ $row->berat }} Kg</td>
                                <td class="p-4 font-bold text-emerald-600">
                                    +{{ $row->status === 'approved' ? number_format($row->poin_didapat) : 0 }} Poin
                                </td>
                                <td class="p-4">
                                    @if($row->status === 'approved')
                                        <span class="px-2.5 py-1 text-[10px] font-bold bg-green-50 text-green-700 rounded-full border border-green-100">Disetujui</span>
                                    @elseif($row->status === 'rejected')
                                        <span class="px-2.5 py-1 text-[10px] font-bold bg-red-50 text-red-700 rounded-full border border-red-100">Ditolak</span>
                                    @else
                                        <span class="px-2.5 py-1 text-[10px] font-bold bg-amber-50 text-amber-700 rounded-full border border-amber-100">Menunggu Konfirmasi</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-slate-400 font-normal">Belum ada rekaman riwayat pengajuan setoran limbah.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>