<div>
 {{-- Bouton d'état actuel (non cliquable) --}}
<span class="px-2 py-1 rounded text-xs font-semibold
    {{ $user->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
    {{ $user->status ? 'Actif' : 'Suspendu' }}
</span>

{{-- Bouton pour changer l'état --}}
<button wire:click="toggleStatus"
    class="ml-2 px-2 py-1 rounded text-xs font-medium
    {{ $user->status ? 'bg-red-500 text-white' : 'bg-green-500 text-white' }}">
    {{ $user->status ? 'Suspendre' : 'Activer' }}
</button>


</div>
