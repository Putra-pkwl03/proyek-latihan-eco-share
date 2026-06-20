<x-app-layout>
    <div class="p-6 max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-slate-800">Laporan Transaksi</h2>
                <p class="text-slate-500 text-sm">Rekapitulasi data setoran dan distribusi biomassa.</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.laporan.cetak') }}" target="_blank" class="bg-red-700 text-white px-4 py-2 rounded font-bold text-sm hover:bg-red-800 transition">📄 Export PDF</a>
                <a href="#" class="bg-green-700 text-white px-4 py-2 rounded font-bold text-sm hover:bg-green-800 transition">📊 Export Excel</a>
            </div>
        </div>

        <form method="GET" action="{{ route('admin.laporan.index') }}" class="bg-white p-4 rounded-lg border border-slate-200 mb-6 flex gap-4 items-end shadow-sm">
            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Mulai Tanggal</label>
                <input type="date" name="start_date" value="{{ $start ?? date('Y-m-01') }}" class="border-slate-300 rounded-md p-2 text-sm w-40">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ $end ?? date('Y-m-t') }}" class="border-slate-300 rounded-md p-2 text-sm w-40">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md text-sm font-bold hover:bg-blue-700 transition">Filter Data</button>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white p-4 rounded-lg border border-slate-200 shadow-sm">
                <p class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">Total Setoran</p>
                <h3 class="text-xl font-black text-slate-800">{{ number_format($totalSetoran ?? 0, 2) }} Kg</h3>
            </div>
            <div class="bg-white p-4 rounded-lg border border-slate-200 shadow-sm">
                <p class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">Total Poin</p>
                <h3 class="text-xl font-black text-emerald-600">{{ number_format($totalPoin ?? 0) }}</h3>
            </div>
            <div class="bg-white p-4 rounded-lg border border-slate-200 shadow-sm">
                <p class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">Transaksi Sukses</p>
                <h3 class="text-xl font-black text-blue-600">{{ $transaksi->where('status', 'approved')->count() }}</h3>
            </div>
            <div class="bg-white p-4 rounded-lg border border-slate-200 shadow-sm">
                <p class="text-[10px] text-slate-400 uppercase font-bold tracking-wider">Transaksi Ditolak</p>
                <h3 class="text-xl font-black text-red-600">{{ $transaksi->where('status', 'rejected')->count() }}</h3>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr class="text-left">
                        <th class="p-4 font-bold text-slate-600">No</th>
                        <th class="p-4 font-bold text-slate-600">Tanggal</th>
                        <th class="p-4 font-bold text-slate-600">Keterangan</th>
                        <th class="p-4 font-bold text-slate-600">Petani/Industri</th>
                        <th class="p-4 font-bold text-slate-600">Jenis Biomassa</th>
                        <th class="p-4 font-bold text-slate-600">Jumlah</th>
                        <th class="p-4 font-bold text-slate-600">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($transaksi as $index => $item)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="p-4 text-slate-500">{{ $index + 1 }}</td>
                        <td class="p-4 text-slate-600">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                        <td class="p-4 font-medium">{{ $item->keterangan ?? 'Setoran Biomassa' }}</td>
                        <td class="p-4">{{ $item->user->name ?? '-' }}</td>
                        <td class="p-4 capitalize">{{ $item->jenis_limbah }}</td>
                        <td class="p-4 font-bold">{{ number_format($item->berat ?? 0) }} Kg</td>
                        <td class="p-4">
                            <span class="px-2 py-1 rounded-full text-[10px] font-bold uppercase 
                                {{ $item->status == 'approved' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-slate-400">Tidak ada data transaksi pada periode ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-10 flex justify-end">
            <div class="text-center w-48">
                <p class="text-sm">Disahkan Oleh,</p>
                <div class="h-20"></div> 
                <p class="font-bold border-t border-black pt-1">Admin Koperasi</p>
            </div>
        </div>
    </div>
</x-app-layout>