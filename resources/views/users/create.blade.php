@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto mt-10" x-data="registerForm()" x-init="init()">
        <h2 class="text-2xl font-bold mb-6 text-center">Créer un nouvel utilisateur</h2>

        {{-- Affichage des erreurs --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-4 mb-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            {{-- Nom + Email --}}
            <div class="mb-4 flex flex-col md:flex-row gap-4">
                <div class="w-full md:w-1/2">
                    <label class="block font-medium" for="name">Nom</label>
                    <input type="text" name="name" class="w-full border rounded p-2" required>
                </div>
                <div class="w-full md:w-1/2">
                    <label class="block font-medium" for="surnname">Prénom(s)</label>
                    <input type="text" name="surname" class="w-full border rounded p-2" required>
                </div>
            </div>
            <!-- Nom d'utilisateur et email -->
            <div class="mb-4 flex flex-col md:flex-row gap-4">
                <div class="w-full md:w-1/2">
                    <label class="block font-medium" for="username">Nom d'utilisateur</label>
                    <input type="text" name="username" class="w-full border rounded p-2" required>
                </div>
                <div class="w-full md:w-1/2">
                    <label class="block font-medium" for="email">Email</label>
                    <input type="email" name="email" class="w-full border rounded p-2" required>
                </div>
            </div>
            {{-- Téléphone 1 + Téléphone 2 --}}
            <div class="mb-4 flex flex-col md:flex-row gap-4">
                <div class="w-full md:w-1/2">
                    <label class="block font-medium" for="contact">Contact 1</label>
                    <input type="text" name="contact" class="w-full border rounded p-2" required>
                </div>
                <div class="w-full md:w-1/2">
                    <label class="block font-medium" for="contact_2">Contact 2</label>
                    <input type="text" name="contact_2" class="w-full border rounded p-2">
                </div>
            </div>

            {{-- Résidence + Quartier --}}
            <div class="mb-4 flex flex-col md:flex-row gap-4">
                <div class="w-full md:w-1/2">
                    <label class="block font-medium" for="residence">Résidence</label>
                    <select name="residence" x-model="residence" class="w-full border rounded p-2" required>
                        <option value="" disabled selected>Choisir une résidence</option>
                        <template x-for="loc in residences" :key="loc">
                            <option :value="loc" x-text="loc"></option>
                        </template>
                    </select>
                </div>
                <div class="w-full md:w-1/2">
                    <label class="block font-medium" for="neighborhood">Quartier</label>
                    <select name="neighborhood" x-model="neighborhood" class="w-full border rounded p-2" required>
                        <option value="" disabled selected>Choisir un quartier</option>
                        <template x-for="q in neighborhoods" :key="q">
                            <option :value="q" x-text="q"></option>
                        </template>
                    </select>
                </div>
            </div>

            {{-- Ville + Mairie --}}
             <div class="mb-4 flex flex-col md:flex-row gap-4">
                <div class="w-full md:w-1/2">
                    <label class="block font-medium" for="residence">Ville de Travail</label>
                    <select name="municipal_office_city" x-model="city" class="w-full border rounded p-2" required>
                        <option value="" disabled selected>Choisir une ville</option>
                        <template x-for="city in cities" :key="city">
                            <option :value="city" x-text="city"></option>
                        </template>
                    </select>
                </div>
                <div class="w-full md:w-1/2">
                    <label class="block font-medium" for="municipalOffice">Mairie de Travail</label>
                    <select name="municipal_office" x-model="municipalOffice" class="w-full border rounded p-2" required>
                        <option value="" disabled selected>Choisir une Mairie</option>
                        <template x-for="q in municipalOffices" :key="q">
                            <option :value="q" x-text="q"></option>
                        </template>
                    </select>
                </div>
            </div>
   
            {{-- Mot de passe + Confirmation --}}
            <div class="mb-6 flex flex-col md:flex-row gap-4">
                <div class="w-full md:w-1/2">
                    <label class="block font-medium" for="password">Mot de passe</label>
                    <input type="password" name="password" class="w-full border rounded p-2" required>
                </div>
                <div class="w-full md:w-1/2">
                    <label class="block font-medium" for="password_confirmation">Confirmer</label>
                    <input type="password" name="password_confirmation" class="w-full border rounded p-2" required>
                </div>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>

@endsection