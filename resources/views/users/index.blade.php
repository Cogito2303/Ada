@extends('layouts.app')
@section('content')

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
      <tr>
      <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">#</th>
      <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Nom</th>
      <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Email</th>
      <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Résidence</th>
      <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Rôle</th>
      <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr class="border-t">
      <td class="px-4 py-2 text-sm text-gray-600">{{ $loop->iteration }}</td>
      <td class="px-4 py-2 text-sm text-gray-600">{{ $user->name }}</td>
      <td class="px-4 py-2 text-sm text-gray-600">{{ $user->email }}</td>
      <td class="px-4 py-2 text-sm text-gray-600">{{ $user->residence }}</td>
      <td class="px-4 py-2 text-sm text-gray-600">{{ $user->role }}</td>
      <td class="px-4 py-2 text-sm text-gray-600">
      <a href="{{ route('users.edit', $user->id) }}"
      class="text-sm text-indigo-600 hover:underline hover:text-indigo-800 mr-4">
      ✏️ Modifier
      </a>
      <form method="POST" action="{{ route('users.destroy', $user->id) }}" class="inline-block"
      onsubmit="return confirm('Confirmer la suppression de cet utilisateur ?')">
      @csrf
      @method('DELETE')
      <button type="submit" class="text-sm text-red-600 hover:underline hover:text-red-800">
        🗑️ Supprimer
      </button>
      </form>
      </td>
      </tr>
    @endforeach
    </tbody>
    </table>
  </div>
@endsection