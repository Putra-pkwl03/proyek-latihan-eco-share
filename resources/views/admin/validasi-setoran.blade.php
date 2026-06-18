<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Konfirmasi & Validasi Setoran Limbah Petani') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow-lg p-6 overflow-hidden">
                <h3 class="text-lg font-bold mb-4 text-gray-800">Antrean Setoran Masuk</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <th class="px-5 py-3">Nama Petani</th>
                                <th class="px-5 py-3">Jenis Limbah</th>
                                <th class="px-5 py-3">Berat (Kg)</th>
                                <th class="px-5 py-3">Tanggal Setor</th>
                                <th class="px-5 py-3">Status</th>
                                <th class="px-5 py-3 text-center">Aksi Validasi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @forelse($daftarSetoran as $item)
                            <tr class="border-b border-gray-200">
                                <td class="px-5 py-4 font-medium text-gray-900">{{ $item->user->name }}</td>
                                <td class="px-5 py-4 capitalize">{{ $item->jenis_limbah }}</td>
                                <td class="px-5 py-4">{{ $item->berat }} Kg</td>
                                <td class="px-5 py-4">{{ \Carbon\Carbon::parse($item->tanggal_setor)->format('d M Y') }}</td>
                                <td class="px-5 py-4">
                                    @if($item->status == 'pending')
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">Pending</span>
                                    @elseif($item->status == 'approved')
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Approved</span>
                                    @else
                                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Rejected</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-center">
                                    @if($item->status == 'pending')
                                        <div class="flex justify-center gap-2">
                                            <form action="{{ route('admin.validasi.update', $item->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs font-semibold shadow"> Setujui </button>
                                            </form>

                                            <form action="{{ route('admin.validasi.update', $item->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs font-semibold shadow"> Tolak </button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-xs italic">Selesai divalidasi</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-5 py-4 text-center text-gray-500">Belum ada antrean setoran limbah dari petani.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>