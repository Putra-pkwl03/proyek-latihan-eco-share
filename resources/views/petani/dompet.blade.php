<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dompet Poin Ekonomi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-green-600 text-white p-6 rounded-lg shadow-lg">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-green-100">Total Poin Ekonomi</h3>
                    <p class="text-4xl font-bold mt-2">{{ number_format($totalPoin) }} <span class="text-xl font-normal">Poin</span></p>
                    <p class="text-xs mt-2 text-green-200">* Otomatis bertambah setelah setoran dikonfirmasi Admin (1 Kg = 10 Poin)</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-lg p-6 overflow-hidden">
                <h2 class="text-lg font-bold mb-4 text-gray-800">Riwayat Transaksi & Konversi Poin</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <th class="px-5 py-3">Tanggal</th>
                                <th class="px-5 py-3">Jenis Limbah</th>
                                <th class="px-5 py-3">Berat (Kg)</th>
                                <th class="px-5 py-3">Poin Diperoleh</th>
                                <th class="px-5 py-3">Status Setoran</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @forelse($riwayatPoin as $item)
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-5 py-4">{{ \Carbon\Carbon::parse($item->tanggal_setor)->format('d M Y') }}</td>
                                <td class="px-5 py-4 capitalize">{{ $item->jenis_limbah }}</td>
                                <td class="px-5 py-4">{{ $item->berat }} Kg</td>
                                <td class="px-5 py-4 font-bold text-green-600">
                                    +{{ $item->status == 'approved' ? $item->poin_didapat : 0 }} Poin
                                </td>
                                <td class="px-5 py-4">
                                    @if($item->status == 'pending')
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">Menunggu Konfirmasi</span>
                                    @elseif($item->status == 'approved')
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">Disetujui</span>
                                    @else
                                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-5 py-4 text-center text-gray-500">Belum ada riwayat transaksi setoran limbah.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>