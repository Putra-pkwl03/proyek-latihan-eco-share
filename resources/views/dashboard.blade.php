<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Petani') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-amber-100 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Selamat Datang! Anda berhasil login sebagai Petani.") }}
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex flex-col md:flex-row justify-between items-center bg-green-50 p-6 rounded-xl border border-green-200">
                    <div>
                        <h3 class="text-lg font-bold text-green-800 mb-1">Dompet Poin Ekonomi BIO-GRIDS</h3>
                        <p class="text-sm text-gray-600">Pantau riwayat konversi limbah sawit & sekam padi menjadi poin ekonomi kamu di sini.</p>
                    </div>
                    
                    <div class="mt-4 md:mt-0">
                        <a href="{{ route('petani.dompet') }}" class="inline-flex items-center px-5 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg shadow transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                            Buka Dompet Poin
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>