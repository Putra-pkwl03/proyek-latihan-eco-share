<x-app-layout>
    <div class="p-8">
        <h1 class="text-2xl font-bold mb-6">Data Petani</h1>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-slate-400">
                        <th class="p-4">Nama</th>
                        <th class="p-4">Email</th>
                        <th class="p-4">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($petani as $p)
                    <tr class="border-t">
                        <td class="p-4">{{ $p->name }}</td>
                        <td class="p-4">{{ $p->email }}</td>
                        <td class="p-4 text-emerald-600">Aktif</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
