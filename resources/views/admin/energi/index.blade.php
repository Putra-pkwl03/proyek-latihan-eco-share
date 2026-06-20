<x-app-layout>
    <div class="p-6">
        <h2 class="text-xl font-bold mb-4">Input Konversi Energi</h2>
        
        <form action="{{ route('admin.energi.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-sm border">
            @csrf
            <div class="mb-4">
                <label>Pilih Log Distribusi yang dikonversi:</label>
                <select name="distribusi_id" class="w-full border rounded p-2">
                    @foreach(\App\Models\Distribusi::all() as $d)
                        <option value="{{ $d->id }}">{{ $d->nama_industri }} - {{ $d->jumlah_kirim }} Kg</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label>Total Energi (kWh):</label>
                <input type="number" name="total_kwh" step="0.01" class="w-full border rounded p-2" required>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Konversi</button>
        </form>
    </div>
</x-app-layout>