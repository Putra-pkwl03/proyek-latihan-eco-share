<x-app-layout>
    <div class="p-6 space-y-6">
        
        <div>
            <h2 class="text-xl font-bold text-slate-800">Manajemen Stok & Distribusi Energi</h2>
            <p class="text-xs text-slate-400 mt-0.5">Pantau kapasitas biomassa real-time dan kelola log pengiriman logistik.</p>
        </div>

        {{-- Pesan Sukses & Error --}}
        @if(session('success'))
            <div class="p-3.5 bg-emerald-50 border border-emerald-100 text-emerald-800 rounded-xl text-xs font-semibold">
                ✅ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="p-3.5 bg-red-50 border border-red-100 text-red-800 rounded-xl text-xs font-semibold">
                ⚠️ {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Kondisi Gudang --}}
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 space-y-4">
                <h3 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Kondisi Gudang Saat Ini</h3>
                
                <div class="p-4 bg-blue-50 border border-blue-100 rounded-xl">
                    <span class="text-[10px] uppercase font-bold text-blue-800 tracking-wide">Kelapa Sawit</span>
                    <h4 class="text-2xl font-black text-slate-800 mt-1">{{ number_format($stokSawit, 0, ',', '.') }} <span class="text-xs text-slate-400 font-normal">Kg</span></h4>
                </div>
                
                <div class="p-4 bg-amber-50 border border-amber-100 rounded-xl">
                    <span class="text-[10px] uppercase font-bold text-amber-800 tracking-wide">Sekam Padi</span>
                    <h4 class="text-2xl font-black text-slate-800 mt-1">{{ number_format($stokPadi, 0, ',', '.') }} <span class="text-xs text-slate-400 font-normal">Kg</span></h4>
                </div>
            </div>

            {{-- Form Distribusi --}}
            <div class="lg:col-span-2 bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                <h3 class="text-xs font-bold text-slate-700 mb-4 uppercase tracking-wider">Catat Distribusi Keluar</h3>
                
                <form action="{{ route('admin.distribusi.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">Tanggal Pengiriman</label>
                        <input type="date" name="tanggal_kirim" value="{{ date('Y-m-d') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">Industri Mitra</label>
                        <select name="nama_industri" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs focus:ring-2 focus:ring-blue-500" required>
                            <option value="PT Energi Hijau Mandiri">PT Energi Hijau Mandiri</option>
                            <option value="CV Biomassa Nusantara">CV Biomassa Nusantara</option>
                            <option value="PT Solusi Makmur">PT Solusi Makmur</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">Jenis Biomassa</label>
                        <select name="jenis_biomassa" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs focus:ring-2 focus:ring-blue-500" required>
                            <option value="kelapa sawit">Kelapa Sawit</option>
                            <option value="sekam padi">Sekam Padi</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase mb-2">Jumlah Kirim (Kg)</label>
                        <input type="number" name="jumlah_kirim" min="1" placeholder="Contoh: 1500" class="w-full bg-slate-50 border border-slate-200 rounded-xl p-3 text-xs focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="md:col-span-2 pt-2">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl text-xs tracking-wider transition-all shadow-md uppercase">
                            🚚 Rilis Pengiriman Logistik
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Tabel Riwayat --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-5 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Riwayat Logistik Keluar</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs text-slate-600">
                    <thead class="bg-slate-50 text-[10px] text-slate-400 uppercase font-bold tracking-wider border-b border-slate-100">
                        <tr>
                            <th class="p-4">Tanggal</th>
                            <th class="p-4">Industri Mitra</th>
                            <th class="p-4">Jenis</th>
                            <th class="p-4">Jumlah</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($distribusis ?? [] as $row)
                            <tr class="hover:bg-slate-50/50">
                                <td class="p-4 text-slate-400">{{ \Carbon\Carbon::parse($row->tanggal_kirim)->format('d/m/Y') }}</td>
                                <td class="p-4 font-bold text-slate-800">{{ $row->nama_industri }}</td>
                                <td class="p-4 capitalize">{{ $row->jenis_biomassa }}</td>
                                <td class="p-4 text-blue-600 font-bold">{{ number_format($row->jumlah_kirim, 0, ',', '.') }} Kg</td>
                                <td class="p-4 text-center">
                                    <form action="{{ route('admin.distribusi.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan distribusi ini? Stok akan dikembalikan.')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-semibold underline">Batalkan</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-slate-400 italic">Belum ada riwayat distribusi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>