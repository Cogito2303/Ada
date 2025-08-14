<div class="flex items-center gap-2 text-sm">
    <span class="px-2 py-0.5 rounded-full text-white text-xs font-semibold 
        {{ $certificate->status === 'processed' ? 'bg-green-500' : 'bg-red-400' }}">
        <!-- {{ ucfirst($certificate->status) }} -->
        {{ $certificate->status === 'processed' ? 'Traité' : 'Attente' }}
    </span>

    <button wire:click="toggleStatus"
            class="px-2 py-1 text-xs rounded-md bg-blue-500 hover:bg-blue-600 text-white transition">
        {{ $certificate->status === 'pending' ? 'Traiter' : 'Changer'}}
    </button>
</div>
