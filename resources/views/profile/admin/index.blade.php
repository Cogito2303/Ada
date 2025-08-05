@extends('layouts.app')
@section('content')
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Profil du Super Admin</h2>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-900 rounded-lg shadow p-6">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('profile.admin.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Avatar -->
                <div class="mb-6 flex items-center gap-4">
                    <img src="{{ auth()->user()->avatar_url ?? '/default-avatar.png' }}" alt="Avatar"
                         class="h-16 w-16 rounded-full object-cover border">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Changer l’avatar</label>
                        <input type="file" name="avatar" class="mt-1 block text-sm text-gray-600 dark:text-gray-400">
                    </div>
                </div>

                <!-- Infos personnelles -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom</label>
                        <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}"
                               class="mt-1 block w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white" required>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                               class="mt-1 block w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white" required>
                    </div>
                </div>

                <!-- Mot de passe -->
                <div class="mt-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nouveau mot de passe</label>
                    <input type="password" id="password" name="password"
                           class="mt-1 block w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white">
                </div>

                <div class="mt-8 text-right">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Mettre à jour
                    </button>

                </div>
            </form>
        </div>
    </div>
@endsection