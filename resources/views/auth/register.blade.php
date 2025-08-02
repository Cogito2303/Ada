@extends('layouts.app')
@section('content')


<form method="POST" action="{{ route('register') }}" x-data="registerForm()" x-init="init()">
    @csrf

    <!-- Résidence -->
    <div class="mt-4">
        <x-label for="residence" :value="__('Résidence')" />
        <select id="residence" name="residence" class="block mt-1 w-full" x-model="residence" required>
            <option value="" disabled selected>Choisissez votre résidence</option>
            <template x-for="location in residences" :key="location">
                <option :value="location" x-text="location"></option>
            </template>
        </select>
    </div>

    <!-- Quartier -->
    <div class="mt-4">
        <x-label for="neighborhood" :value="__('Quartier')" />
        <select id="neighborhood" name="neighborhood" class="block mt-1 w-full" x-model="neighborhood" required>
            <option value="" disabled selected>Choisissez votre quartier</option>
            <template x-for="area in neighborhoods" :key="area">
                <option :value="area" x-text="area"></option>
            </template>
        </select>
    </div>

    <!-- Autres champs -->
    <div class="mt-4">
        <x-label for="name" :value="__('Name')" />
        <x-input id="name" type="text" name="name" class="block mt-1 w-full" required autofocus autocomplete="name" />
    </div>

    <div class="mt-4">
        <x-label for="email" :value="__('Email')" />
        <x-input id="email" type="email" name="email" class="block mt-1 w-full" required autocomplete="email" />
    </div>

    <div class="mt-4">
        <x-label for="password" :value="__('Password')" />
        <x-input id="password" type="password" name="password" class="block mt-1 w-full" required autocomplete="new-password" />
    </div>

    <div class="mt-4">
        <x-label for="password_confirmation" :value="__('Confirm Password')" />
        <x-input id="password_confirmation" type="password" name="password_confirmation" class="block mt-1 w-full" required autocomplete="new-password" />
    </div>

    <div class="flex items-center justify-end mt-4">
        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>

        <x-button class="ms-4">
            {{ __('Register') }}
        </x-button>
    </div>
</form>


@endsection