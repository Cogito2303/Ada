@extends('layouts.app')
@section('content')
  <div class="max-w-7xl mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4 text-gray-800">Liste des utilisateurs</h2>
    <div class="flex justify-end mb-4">
  <a href="{{ route('users.create') }}"
     class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded shadow hover:bg-green-700 transition">
    ➕ Ajouter un utilisateur
  </a>
</div>

    <table class="min-w-full bg-white border border-gray-300 rounded shadow">
    <thead class="bg-gray-100">
      <tr class="divide-y divide-x divide-gray-600">
      <th class="px-2 py-1 text-left text-sm font-semibold text-gray-700">#</th>
      <th class="px-2 py-1 text-left text-sm font-semibold text-gray-700">Nom</th>
      <th class="px-2 py-1 text-left text-sm font-semibold text-gray-700">Email</th>
      <th class="px-2 py-1 text-left text-sm font-semibold text-gray-700">Résidence</th>
      <th class="px-2 py-1 text-left text-sm font-semibold text-gray-700">Rôle</th>
      <th class="px-2 py-1 text-left text-sm font-semibold text-gray-700">Actions</th>
      <th class="px-2 py-1 text-left text-sm font-semibold text-gray-700">Status</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-gray-100">
      @foreach ($users as $user)
      <tr class="divide-y divide-x divide-gray-200">
      <td class="px-2 py-1 text-sm text-gray-600">{{ $loop->iteration }}</td>
      <td class="px-2 py-1 text-sm text-gray-600">{{ $user->name }}</td>
      <td class="px-2 py-1 text-sm text-gray-600">{{ $user->email }}</td>
      <td class="px-2 py-1 text-sm text-gray-600">{{ $user->residence }}</td>
      <td class="px-2 py-1 text-sm text-gray-600">{{ $user->role }}</td>
      <!-- Action -->
      <td class="px-2 py-1 border-b text-sm text-gray-700 text-center space-x-4">
          <a href="{{ route('users.edit', $user->id) }}"
            class="inline-flex items-center px-3 py-1 rounded-md bg-indigo-100 text-indigo-700 hover:bg-indigo-200 transition duration-200">
               ✏️
          </a>

          <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="inline-block"
                onsubmit="return confirm('Confirmer la suppression de cet utilisateur ?')">
              @csrf
              @method('DELETE')
              <button type="submit"
                  class="inline-flex items-center px-3 py-1 rounded-md bg-red-100 text-red-700 hover:bg-red-200 transition duration-200">
                   🗑️
              </button>
          </form>
      </td>
      <!-- Fin Action -->

      <!-- Status -->
      <td>
            <livewire:user-status :user="$user" />
        </td>

    <!-- Fin status -->

      </tr>
    @endforeach
    </tbody>
    </table>
  </div>
@endsection