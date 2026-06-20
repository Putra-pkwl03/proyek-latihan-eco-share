 <x-app-layout>
    <div class="p-6 space-y-6">
        
        <div>
            <h2 class="text-xl font-bold text-slate-800">Validasi Setoran Limbah Petani</h2>
            <p class="text-xs text-slate-400 mt-0.5">Konfirmasi dan validasi berkas ajuan masuk dari warga tani.</p>
        </div>

        @if(session('success'))
            <div class="p-3.5 bg-blue-50 border border-blue-100 text-blue-800 rounded-xl text-xs font-semibold">
                🔹 {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-5 border-b border-slate-100 bg-slate-50/50">
                <h3 class="text-xs font-bold text-slate-700 uppercase tracking-wider">Antrean Persetujuan Setoran</h3>
            </div>
            <table class="w-full text-left text-xs text-slate-600">
                <thead class="bg-slate-50 text-[10px] text-slate-400 uppercase font-bold tracking-wider border-b border-slate-100">
                    <tr>
                        <th class="p-4">Nama Petani</th>
                        <th class="p-4">Tanggal Masuk</th>
                        <th class="p-4">Jenis Limbah</th>
                        <th class="p-4">Berat</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-center">Tindakan Validasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 font-medium text-slate-700">
                    @forelse($setorans ?? [] as $row)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="p-4">
                                <div class="font-bold text-slate-800">{{ $row->user->name ?? 'Petani Anonim' }}</div>
                                <span class="text-[10px] text-slate-400">ID: #{{ $row->user_id }}</span>
                            </td>
                            <td class="p-4 text-slate-400">{{ $row->tanggal_setor }}</td>
                            <td class="p-4 capitalize font-semibold">{{ $row->jenis_limbah }}</td>
                            <td class="p-4 text-blue-600 font-bold">{{ $row->berat }} Kg</td>
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
                                        <form action="{{ route('admin.validasi.update', $row->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-3 py-1.5 rounded-lg text-[11px] transition-all shadow-sm shadow-blue-600/10">
                                                ✅ Setujui
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.validasi.update', $row->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 font-bold px-3 py-1.5 rounded-lg text-[11px] transition-all">
                                                ❌ Tolak
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-slate-400 font-normal text-[11px] italic">Selesai Diproses</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-slate-400 font-normal">Tidak ada antrean setoran limbah baru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
