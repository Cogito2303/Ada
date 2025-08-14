<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
        
 <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Se connecter</h1>
         <!-- ✅ Message personnalisé pour les comptes inactifs -->
        @if (session('inactive_error'))
            <div class="px-4 py-2 mb-4 font-semibold bg-yellow-500 rounded p-4">
                {{ session('inactive_error') }}
            </div>
        @endif

        <!-- @if ($errors->any())
            <div class="mb-4 text-red-600 font-semibold">
                {{ implode(', ', $errors->all()) }}
            </div>
        @endif -->

        <!-- @if (session('status'))
            <div class="mb-4 text-green-600 font-medium">
                {{ session('status') }}
            </div>
        @endif -->

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required autofocus
                       value="{{ old('email') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input type="password" name="password" id="password" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    <span class="ml-2 text-sm text-gray-600">Se souvenir de moi</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline">
                        Mot de passe oublié ?
                    </a>
                @endif
            </div>

            <button type="submit"
                    class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700 transition">
                Connexion
            </button>
        </form>
    </div>

    </x-authentication-card>
</x-guest-layout>
