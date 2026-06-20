<x-app-layout>
<div class="bg-white border-b border-slate-100 px-8 py-4 flex justify-between items-center w-full">
        <div></div> 

        <div class="flex items-center gap-6">
            <button class="p-2 bg-slate-50 hover:bg-slate-100 rounded-xl text-slate-500 relative transition-all border border-slate-100">
                🔔
            </button>
            <div class="flex items-center gap-3 border-l pl-6 border-slate-100">
                <div class="text-right">
                    <h4 class="text-xs font-bold text-slate-700 leading-none">{{ Auth::user()->name }}</h4>
                    <span class="text-[10px] text-slate-400 font-medium uppercase">{{ Auth::user()->role }}</span>
                </div>
                <div class="w-10 h-10 rounded-xl flex items-center justify-center font-bold text-white uppercase text-xs bg-emerald-600">
                    {{ substr(Auth::user()->name, 0, 2) }}
                </div>
            </div>
        </div>
    </div>

<div class="p-8 space-y-6">
    
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
        <h2 class="text-2xl font-bold text-slate-800">Selamat Datang, {{ Auth::user()->name }} 👋</h2>
        <p class="text-sm text-slate-500 mt-1">
            Lokasi Layanan: <span class="text-emerald-600 font-semibold">Kec. Prambanan</span>
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        </div>

</div>

        @if(Auth::user()->role === 'admin')
            
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">👥 Total Petani</span>
                    <h3 class="text-xl font-black text-slate-800 mt-1">150 <span class="text-xs font-normal text-slate-400">Orang</span></h3>
                </div>
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">🌲 Total Stok Biomassa</span>
                    <h3 class="text-xl font-black text-blue-600 mt-1">25.000 <span class="text-xs font-normal text-slate-400">Kg</span></h3>
                </div>
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">⏳ Setoran Pending</span>
                    <h3 class="text-xl font-black text-amber-500 mt-1">32 <span class="text-xs font-normal text-slate-400">Data</span></h3>
                </div>
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">🚚 Total Distribusi</span>
                    <h3 class="text-xl font-black text-slate-800 mt-1">12.000 <span class="text-xs font-normal text-slate-400">Kg</span></h3>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                    <h3 class="text-xs font-bold text-slate-700 mb-4 uppercase tracking-wider">Total Setoran Limbah per Bulan (Kg)</h3>
                    <div class="h-64">
                        <canvas id="chartBatangAdmin"></canvas>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between">
                    <h3 class="text-xs font-bold text-slate-700 mb-4 uppercase tracking-wider">Komposisi Stok Biomassa</h3>
                    <div class="h-48 flex items-center justify-center">
                        <canvas id="chartPieAdmin"></canvas>
                    </div>
                    <div class="flex justify-center gap-4 text-[11px] font-medium text-slate-500 mt-2">
                        <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 bg-blue-600 rounded-full block"></span> Kelapa Sawit (60%)</span>
                        <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 bg-amber-500 rounded-full block"></span> Sekam Padi (40%)</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                    <h3 class="text-xs font-bold text-slate-700 mb-3 uppercase tracking-wider">Top 5 Petani Penyumbang (Kg Terbesar)</h3>
                    <div class="space-y-2 text-xs">
                        <div class="flex justify-between p-2.5 bg-slate-50 rounded-xl">
                            <span class="font-medium text-slate-700">1. Suyatno</span>
                            <span class="font-bold text-slate-900">1.250 Kg</span>
                        </div>
                        <div class="flex justify-between p-2.5 bg-slate-50 rounded-xl">
                            <span class="font-medium text-slate-700">2. Trisno</span>
                            <span class="font-bold text-slate-900">1.000 Kg</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                    <h3 class="text-xs font-bold text-slate-700 mb-3 uppercase tracking-wider">Aktivitas Terbaru</h3>
                    <div class="space-y-2.5 text-[11px]">
                        <div class="flex justify-between items-center border-b pb-2 border-slate-100">
                            <span class="text-slate-500">Febi mengajukan setoran 50 Kg Sekam Padi</span>
                            <span class="px-2 py-0.5 bg-blue-50 text-blue-600 rounded-md font-bold">Setoran</span>
                        </div>
                        <div class="flex justify-between items-center border-b pb-2 border-slate-100">
                            <span class="text-slate-500">Admin menyetujui setoran 100 Kg Kelapa Sawit</span>
                            <span class="px-2 py-0.5 bg-emerald-50 text-emerald-600 rounded-md font-bold">Validasi</span>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    new Chart(document.getElementById('chartBatangAdmin'), {
                        type: 'bar',
                        data: {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                            datasets: [{
                                label: 'Total Kg',
                                data: [4000, 5000, 4500, 7000, 6000, 8000],
                                backgroundColor: '#2563eb',
                                borderRadius: 6
                            }]
                        },
                        options: { responsive: true, maintainAspectRatio: false }
                    });

                    new Chart(document.getElementById('chartPieAdmin'), {
                        type: 'pie',
                        data: {
                            labels: ['Kelapa Sawit', 'Sekam Padi'],
                            datasets: [{
                                data: [60, 40],
                                backgroundColor: ['#2563eb', '#f59e0b']
                            }]
                        },
                        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
                    });
                });
            </script>


        @else
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 text-xl flex items-center justify-center">🪙</div>
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Total Poin</span>
                        <h4 class="text-xl font-black text-slate-800 mt-0.5">12.500 <span class="text-xs font-normal text-slate-400">Poin</span></h4>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 text-xl flex items-center justify-center">📦</div>
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Total Setoran</span>
                        <h4 class="text-xl font-black text-slate-800 mt-0.5">150 <span class="text-xs font-normal text-slate-400">Kg</span></h4>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-500 text-xl flex items-center justify-center">✅</div>
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Setoran Disetujui</span>
                        <h4 class="text-xl font-black text-slate-800 mt-0.5">10 <span class="text-xs font-normal text-slate-400">Data</span></h4>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 flex flex-col justify-between">
                    <div>
                        <h3 class="text-xs font-bold text-slate-700 mb-3 uppercase tracking-wider">Status Setoran Terakhir</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between items-center p-3 bg-slate-50 rounded-xl text-xs">
                                <div>
                                    <h4 class="font-bold text-slate-800">Sekam Padi</h4>
                                    <span class="text-[10px] text-slate-400">15/06/2026</span>
                                </div>
                                <span class="px-2.5 py-1 text-[10px] font-bold bg-green-100 text-green-700 rounded-full">Approved</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-slate-50 rounded-xl text-xs">
                                <div>
                                    <h4 class="font-bold text-slate-800">Kelapa Sawit</h4>
                                    <span class="text-[10px] text-slate-400">12/06/2026</span>
                                </div>
                                <span class="px-2.5 py-1 text-[10px] font-bold bg-amber-100 text-amber-700 rounded-full">Pending</span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('petani.setoran.index') }}" class="text-center text-xs font-bold text-emerald-600 hover:underline mt-4 block">Lihat semua riwayat →</a>
                </div>

                <div class="lg:col-span-2 bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                    <h3 class="text-xs font-bold text-slate-700 mb-4 uppercase tracking-wider">Grafik Poin Ekonomi (Perolehan Poin)</h3>
                    <div class="h-56">
                        <canvas id="chartGarisPetani"></canvas>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    new Chart(document.getElementById('chartGarisPetani'), {
                        type: 'line',
                        data: {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                            datasets: [{
                                label: 'Poin Perolehan',
                                data: [4000, 6000, 8000, 10000, 12000, 12500],
                                borderColor: '#059669',
                                backgroundColor: 'rgba(5, 150, 105, 0.05)',
                                fill: true,
                                tension: 0.3
                            }]
                        },
                        options: { responsive: true, maintainAspectRatio: false }
                    });
                });
            </script>

        @endif

    </div>
</x-app-layout>