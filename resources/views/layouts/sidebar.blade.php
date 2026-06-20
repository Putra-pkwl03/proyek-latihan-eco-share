<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BIO-GRIDS - Sistem Manajemen Biomassa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-slate-50 font-sans antialiased">

    <div class="flex min-h-screen">
        
        <aside class="w-64 flex flex-col justify-between p-5 text-white min-h-screen sticky top-0 shadow-xl transition-colors duration-300 {{ Auth::user()->role === 'admin' ? 'bg-slate-900 border-r border-slate-800' : 'bg-emerald-950 border-r border-emerald-900' }}">
            
            <div class="space-y-6">
                <div class="flex items-center gap-3 px-2 py-2">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center font-black text-white text-md shadow-sm {{ Auth::user()->role === 'admin' ? 'bg-blue-600' : 'bg-emerald-500' }}">
                        BG
                    </div>
                    <div>
                        <h1 class="font-extrabold text-sm tracking-wider leading-none">BIO-GRIDS</h1>
                        <span class="text-[10px] {{ Auth::user()->role === 'admin' ? 'text-blue-400' : 'text-emerald-400' }} font-medium">Energi Berkelanjutan</span>
                    </div>
                </div>

                <nav class="space-y-1">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:text-white' }}">
                        📊 Dashboard
                    </a>

                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.petani.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('admin.petani.*') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:text-white' }}">
                            👥 Data Petani
                        </a>
                        <a href="{{ route('admin.validasi.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('admin.validasi.*') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:text-white' }}">
                            📝 Validasi Setoran
                        </a>
                        <a href="{{ route('admin.distribusi.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('admin.distribusi.*') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:text-white' }}">
                            📦 Stok Biomassa
                        </a>
                        <a href="{{ route('admin.energi.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('admin.energi.*') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:text-white' }}">
                            ⚡ Distribusi Energi
                        </a>
                        
                        <div class="pt-2">
                            <p class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1">Manajemen Laporan</p>
                            <a href="{{ route('admin.laporan.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('admin.laporan.*') ? 'bg-blue-600 text-white' : 'text-gray-400 hover:text-white' }}">
                                📄 Laporan Transaksi
                            </a>
                        </div>
                    @else
                        <a href="{{ route('petani.setoran.create') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('petani.setoran.create') ? 'bg-emerald-800 text-white' : 'text-gray-400 hover:text-white' }}">
                            ⚖️ Setor Limbah
                        </a>
                        <a href="{{ route('petani.dompet') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('petani.dompet') ? 'bg-emerald-800 text-white' : 'text-gray-400 hover:text-white' }}">
                            🪙 Dompet Poin
                        </a>
                        <a href="{{ route('petani.setoran.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('petani.setoran.index') ? 'bg-emerald-800 text-white' : 'text-gray-400 hover:text-white' }}">
                            📜 Riwayat Setoran
                        </a>
                    @endif

                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('profile.edit') ? (Auth::user()->role === 'admin' ? 'bg-blue-600 text-white' : 'bg-emerald-800 text-white') : 'text-gray-400 hover:text-white' }}">
                        👤 Profil
                    </a>
                </nav>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-red-400 hover:bg-red-950/30 transition-all text-left">
                    🚪 Logout
                </button>
            </form>
        </aside>

        <main class="flex-1 min-h-screen bg-slate-50">
            {{ $slot }}
        </main>
    </div>

</body>
</html>