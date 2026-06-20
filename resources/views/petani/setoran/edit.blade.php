 <x-app-layout>
    <div class="p-6 max-w-2xl mx-auto space-y-6">
        
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <div class="border-b pb-4 mb-6">
                <h2 class="text-xl font-bold text-slate-800">✏️ Edit Pengajuan Setoran</h2>
                <p class="text-xs text-slate-400 mt-1">Ubah data pengajuan setoran limbah Anda yang belum divalidasi.</p>
            </div>

            <form action="{{ route('petani.setoran.update', $setoran->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Jenis Limbah</label>
                    <select name="jenis_limbah" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-700 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                        <option value="kelapa sawit" {{ $setoran->jenis_limbah == 'kelapa sawit' ? 'selected' : '' }}>Limbah Kelapa Sawit</option>
                        <option value="sekam padi" {{ $setoran->jenis_limbah == 'sekam padi' ? 'selected' : '' }}>Sekam Padi</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Berat Limbah (Kg)</label>
                    <input type="number" name="berat" value="{{ $setoran->berat }}" min="1" step="any" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Tanggal Setor</label>
                    <input type="date" name="tanggal_setor" value="{{ $setoran->tanggal_setor }}" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" required>
                </div>

                <div class="flex gap-3 pt-2">
                    <a href="{{ route('petani.setoran.index') }}" class="w-1/3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-3.5 px-4 rounded-xl text-xs text-center transition-all">
                        BATAL
                    </a>
                    <button type="submit" class="w-2/3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3.5 px-4 rounded-xl text-xs tracking-wider transition-all shadow-md uppercase">
                        PERBARUI DATA
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>
