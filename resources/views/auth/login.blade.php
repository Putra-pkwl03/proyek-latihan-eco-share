<x-guest-layout>
    <div x-data="{ isLogin: true, showLoginPass: false, showRegPass: false, showConfirmPass: false }" class="w-full max-w-4xl">
        
        <div class="w-full grid grid-cols-1 md:grid-cols-12 bg-gray-950/40 backdrop-blur-2xl border border-gray-800/80 rounded-3xl shadow-2xl overflow-hidden min-h-[550px]">
            
            <div class="flex flex-col justify-between p-8 border-b md:col-span-5 bg-gradient-to-b from-emerald-950/50 to-gray-950/90 md:border-b-0 md:border-r border-gray-800/60">
                
                <div class="space-y-4">
                    <div class="inline-flex items-center justify-center w-12 h-12 border shadow-inner rounded-2xl bg-emerald-500/10 border-emerald-500/20 text-emerald-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-3xl font-black tracking-wider text-white">BIO-GRIDS</h2>
                        <p class="mt-1 text-xs font-semibold tracking-widest uppercase text-emerald-400">Sinergi Energi Terbarukan</p>
                    </div>
                </div>

                <div class="hidden space-y-4 md:block">
                    <p class="text-sm leading-relaxed text-gray-400">
                        Platform integrasi tata kelola distribusi biomassa desa mandiri untuk mendukung akselerasi swasembada ekonomi lokal yang aman dan transparan.
                    </p>
                    <div class="flex items-center gap-3 pt-4 text-xs text-gray-500 border-t border-gray-800/60">
                        <span class="flex w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Sistem Validasi Dashboard Terintegrasi
                    </div>
                </div>
            </div>

            <div class="flex flex-col justify-center p-8 space-y-6 md:col-span-7 md:p-12 bg-gray-900/20">
                
                <div class="flex items-center p-1 border bg-gray-950/80 rounded-2xl border-gray-800/80">
                    <button @click="isLogin = true" 
                            :class="isLogin ? 'bg-emerald-400 text-gray-950 font-bold shadow-lg' : 'text-gray-400 hover:text-gray-200 font-medium'" 
                            class="w-1/2 py-3 text-sm transition duration-200 rounded-xl focus:outline-none">
                        Masuk (Login)
                    </button>
                    <button @click="isLogin = false" 
                            :class="!isLogin ? 'bg-emerald-400 text-gray-950 font-bold shadow-lg' : 'text-gray-400 hover:text-gray-200 font-medium'" 
                            class="w-1/2 py-3 text-sm transition duration-200 rounded-xl focus:outline-none">
                        Daftar (Register)
                    </button>
                </div>

                <x-auth-session-status class="mb-2" :status="session('status')" />

                <div x-show="isLogin" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
                    <form class="space-y-4" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div>
                            <label for="login_email" class="block text-xs font-semibold tracking-wider text-gray-400 uppercase">Alamat Email</label>
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25H4.5A2.25 2.25 0 012.25 17.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5H4.5a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
                                </div>
                                <input id="login_email" type="email" name="email" value="{{ old('email') }}" required autofocus class="block w-full py-3 pl-10 text-sm text-gray-100 placeholder-gray-600 border border-gray-800 bg-gray-950/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="nama@email.com">
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-400" />
                        </div>

                        <div>
                            <label for="login_password" class="block text-xs font-semibold tracking-wider text-gray-400 uppercase">Kata Sandi</label>
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0V10.5m-2.25 0h13.5m-13.5 0a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25h13.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25m-13.5 0h13.5" /></svg>
                                </div>
                                <input id="login_password" :type="showLoginPass ? 'text' : 'password'" name="password" required class="block w-full py-3 pl-10 pr-10 text-sm text-gray-100 placeholder-gray-600 border border-gray-800 bg-gray-950/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="••••••••">
                                
                                <button type="button" @click="showLoginPass = !showLoginPass" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-emerald-400 focus:outline-none">
                                    <svg x-show="!showLoginPass" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    <svg x-show="showLoginPass" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" x-cloak>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                    </svg>
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-400" />
                        </div>

                        <div class="flex items-center justify-between text-xs">
                            <div class="flex items-center">
                                <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 border-gray-800 rounded bg-gray-950 text-emerald-600 focus:ring-emerald-500/50 focus:ring-offset-gray-900 focus:ring-2">
                                <label for="remember_me" class="ml-2 text-gray-400">Ingat sesi saya</label>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="font-medium transition duration-150 text-emerald-400 hover:text-emerald-300">Lupa sandi?</a>
                            @endif
                        </div>

                        <button type="submit" class="w-full flex justify-center py-3.5 px-4 text-sm font-bold rounded-xl text-gray-950 bg-emerald-400 hover:bg-emerald-300 transition duration-200 shadow-xl shadow-emerald-400/10">
                            Masuk ke Dashboard
                        </button>
                    </form>
                </div>

                <div x-show="!isLogin" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0">
                    <form class="space-y-4" method="POST" action="{{ route('register') }}">
                        @csrf

                        <input type="hidden" name="role" value="petani">

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label for="reg_name" class="block text-xs font-semibold tracking-wider text-gray-400 uppercase">Nama Lengkap</label>
                                <input id="reg_name" type="text" name="name" value="{{ old('name') }}" required class="block w-full px-4 py-3 mt-1 text-sm text-gray-100 placeholder-gray-600 border border-gray-800 bg-gray-950/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Nama Anda">
                                <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-red-400" />
                            </div>

                            <div>
                                <label for="reg_email" class="block text-xs font-semibold tracking-wider text-gray-400 uppercase">Alamat Email</label>
                                <input id="reg_email" type="email" name="email" value="{{ old('email') }}" required class="block w-full px-4 py-3 mt-1 text-sm text-gray-100 placeholder-gray-600 border border-gray-800 bg-gray-950/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="nama@email.com">
                                <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-400" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label for="reg_password" class="block text-xs font-semibold tracking-wider text-gray-400 uppercase">Kata Sandi</label>
                                <div class="relative mt-1 rounded-md shadow-sm">
                                    <input id="reg_password" :type="showRegPass ? 'text' : 'password'" name="password" required class="block w-full py-3 pl-4 pr-10 text-sm text-gray-100 placeholder-gray-600 border border-gray-800 bg-gray-950/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Min. 8 karakter">
                                    
                                    <button type="button" @click="showRegPass = !showRegPass" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-emerald-400 focus:outline-none">
                                        <svg x-show="!showRegPass" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                        <svg x-show="showRegPass" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" x-cloak>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                        </svg>
                                    </button>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-400" />
                            </div>

                            <div>
                                <label for="reg_password_confirmation" class="block text-xs font-semibold tracking-wider text-gray-400 uppercase">Konfirmasi Sandi</label>
                                <div class="relative mt-1 rounded-md shadow-sm">
                                    <input id="reg_password_confirmation" :type="showConfirmPass ? 'text' : 'password'" name="password_confirmation" required class="block w-full py-3 pl-4 pr-10 text-sm text-gray-100 placeholder-gray-600 border border-gray-800 bg-gray-950/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" placeholder="Ulangi sandi">
                                    
                                    <button type="button" @click="showConfirmPass = !showConfirmPass" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-emerald-400 focus:outline-none">
                                        <svg x-show="!showConfirmPass" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        </svg>
                                        <svg x-show="showConfirmPass" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" x-cloak>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                        </svg>
                                    </button>
                                </div>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-red-400" />
                            </div>
                        </div>

                        <button type="submit" class="w-full flex justify-center py-3.5 px-4 text-sm font-bold rounded-xl text-gray-950 bg-emerald-400 hover:bg-emerald-300 transition duration-200 shadow-xl shadow-emerald-400/10 mt-2">
                            Buat Akun & Masuk
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-guest-layout>