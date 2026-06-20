<x-app-layout>
    <div class="p-6 max-w-7xl mx-auto space-y-6">
        
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Menu Pengajuan & Kelola Limbah</h2>
                <p class="text-xs text-slate-400 mt-0.5">Kecamatan : <span class="text-emerald-600 font-semibold">Prambanan</span></p>
            </div>
        </div>

        @if(session('success'))
            <div class="p-3.5 bg-emerald-50 border border-emerald-100 text-emerald-800 rounded-xl text-xs font-semibold flex items-center gap-2">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <div class="border-b pb-4 mb-6">
                    <h2 class="text-sm font-bold text-slate-800">Form Setor Limbah</h2>
                    <p class="text-[11px] text-slate-400 mt-1">Ajukan pencatatan setoran limbah untuk mendapatkan poin ekonomi.</p>
                </div>

                <form action="{{ route('petani.setoran.store') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Jenis Limbah</label>
                        <select name="jenis_limbah" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-700 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:bg-white transition-all" required>
                            <option value="" disabled selected>Pilih Jenis Limbah</option>
                            <option value="kelapa sawit">Limbah Kelapa Sawit</option>
                            <option value="sekam padi">Sekam Padi</option>
                        </select>
                        @error('jenis_limbah')
                            <span class="text-red-500 text-[10px] font-semibold mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Berat Limbah (Kg)</label>
                        <input type="number" name="berat" min="1" step="any" placeholder="Masukkan berat limbah dalam Kg" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:bg-white transition-all" required>
                        @error('berat')
                            <span class="text-red-500 text-[10px] font-semibold mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Tanggal Setor</label>
                        <input type="date" name="tanggal_setor" value="{{ date('Y-m-d') }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 focus:bg-white transition-all" required>
                        @error('tanggal_setor')
                            <span class="text-red-500 text-[10px] font-semibold mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 px-4 rounded-xl text-xs tracking-wider transition-all shadow-md shadow-emerald-600/10 uppercase">
                            SIMPAN PENGAJUAN
                        </button>
                    </div>
                </form>
            </div>

            <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="border-b pb-4 mb-6">
                    <h3 class="text-sm font-bold text-slate-800">Kelola Ajuan Setoran Anda</h3>
                    <p class="text-[11px] text-slate-400 mt-1">Daftar koreksi data (edit) atau pembatalan ajuan setoran yang masih pending.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs text-slate-600">
                        <thead class="bg-slate-50 text-[10px] text-slate-400 uppercase font-bold tracking-wider border-b border-slate-100">
                            <tr>
                                <th class="p-4">Tanggal Setor</th>
                                <th class="p-4">Jenis Limbah</th>
                                <th class="p-4">Berat (Kg)</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                            @forelse($setorans ?? [] as $row)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="p-4 text-slate-400">{{ \Carbon\Carbon::parse($row->tanggal_setor)->format('d/m/Y') }}</td>
                                    <td class="p-4 capitalize font-semibold text-slate-800">{{ $row->jenis_limbah }}</td>
                                    <td class="p-4 font-bold text-emerald-600">{{ $row->berat }} Kg</td>
                                    <td class="p-4">
                                        @if($row->status === 'approved')
                                            <span class="px-2.5 py-1 text-[10px] font-bold bg-green-50 text-green-700 rounded-full border border-green-100">Approved</span>
                                        @elseif($row->status === 'rejected')
                                            <span class="px-2.5 py-1 text-[10px] font-bold bg-red-50 text-red-700 rounded-full border border-red-100">Rejected</span>
                                        @else
                                            <span class="px-2.5 py-1 text-[10px] font-bold bg-amber-50 text-amber-700 rounded-full border border-amber-100">Pending</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-center">
                                        @if($row->status === 'pending')
                                            <div class="flex items-center justify-center gap-2">
                                                <a href="{{ route('petani.setoran.edit', $row->id) }}" class="px-2.5 py-1 bg-amber-50 text-amber-600 hover:bg-amber-100 rounded-lg text-[11px] font-semibold transition-all">
                                                    ✏️ Edit
                                                </a>
                                                <form action="{{ route('petani.setoran.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan setoran ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-2.5 py-1 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg text-[11px] font-semibold transition-all">
                                                        🗑️ Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-slate-400 font-normal italic text-[11px]">Selesai divalidasi</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-8 text-center text-slate-400 font-normal">Belum ada pengajuan setoran limbah saat ini.</td>
                                endtr
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>