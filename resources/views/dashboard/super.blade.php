@extends('layouts.app')

@section('content')

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      @foreach([
        ['title' => 'Utilisateurs', 'count' => $userCount ], //nombre d'utilisateur depuis la base de données
        ['title' => 'Demandes', 'count' => 28],
        ['title' => 'Notifications', 'count' => 5],
        ['title' => 'Archives', 'count' => 320]
      ] as $item)
      <div class="bg-white dark:bg-gray-800 p-4 rounded shadow text-center">
        <h2 class="text-sm font-semibold text-gray-600 dark:text-gray-300 mb-2">{{ $item['title'] }}</h2>
        <p class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">{{ $item['count'] }}</p>
      </div>
      @endforeach
    </div>
@endsection