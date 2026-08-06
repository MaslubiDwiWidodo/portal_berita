<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Pendaftaran Akun</h2>
        <p class="text-sm text-gray-500 mt-1">Buat akun baru untuk bergabung sebagai kontributor portal berita.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
            <input id="name" 
                   type="text" 
                   name="name" 
                   value="{{ old('name') }}" 
                   required 
                   autofocus 
                   autocomplete="name" 
                   placeholder="Nama Lengkap Anda"
                   class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-600 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all text-sm font-medium" />
            <x-input-error :messages="$errors->get('name')" class="mt-1 text-xs text-red-600 font-semibold" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Alamat Email</label>
            <input id="email" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autocomplete="username" 
                   placeholder="email@contoh.com"
                   class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-600 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all text-sm font-medium" />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-xs text-red-600 font-semibold" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Kata Sandi</label>
            <input id="password" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="new-password" 
                   placeholder="Minimal 8 karakter"
                   class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-600 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all text-sm font-medium" />
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-xs text-red-600 font-semibold" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
            <input id="password_confirmation" 
                   type="password" 
                   name="password_confirmation" 
                   required 
                   autocomplete="new-password" 
                   placeholder="Ulangi Kata Sandi"
                   class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-blue-600 focus:ring-2 focus:ring-blue-500/20 outline-none transition-all text-sm font-medium" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-xs text-red-600 font-semibold" />
        </div>

        <div class="flex items-center justify-between pt-2">
            <a class="text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors" href="{{ route('login') }}">
                Sudah punya akun?
            </a>

            <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-bold py-3 px-6 rounded-xl shadow-lg shadow-blue-600/30 transition-all duration-200 text-sm">
                Daftar Akun
            </button>
        </div>
    </form>
</x-guest-layout>
