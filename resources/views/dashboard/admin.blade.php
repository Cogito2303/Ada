<x-app-layout>
    <h2 class="text-xl font-bold">Dashboard Admin</h2>
    <p>Accès aux extraits selon votre résidence : {{ auth()->user()->residence }}</p>
</x-app-layout>