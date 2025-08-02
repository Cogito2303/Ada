@extends('layouts.app')
@section('content')
    <form method="POST" action="{{ route('users.update', $user->id) }}" class="max-w-xl mx-auto p-6 bg-white rounded shadow">
  @csrf
  @method('PUT')

  <h2 class="text-xl font-semibold mb-4 text-gray-800">Modifier l'utilisateur</h2>

  <div class="mb-4">
    <label class="block mb-1 text-sm text-gray-700" for="name">Nom</label>
    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
           class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-indigo-200">
  </div>

  <div class="mb-4">
    <label class="block mb-1 text-sm text-gray-700" for="email">Email</label>
    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
           class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-indigo-200">
  </div>

  <div class="mb-4">
    <label class="block mb-1 text-sm text-gray-700" for="role">Rôle</label>
    <select id="role" name="role"
            class="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:ring-indigo-200">
      <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
      <option value="super_admin" {{ $user->role === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
      <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>Utilisateur</option>
    </select>
  </div>

  <button type="submit"
          class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
    💾 Sauvegarder
  </button>
</form>
@endsection