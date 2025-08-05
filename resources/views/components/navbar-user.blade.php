@php
  function navClass($route) {
    return Route::currentRouteName() === $route
      ? 'text-indigo-600 font-semibold underline underline-offset-4'
      : 'text-gray-700 dark:text-gray-200 hover:text-indigo-600';
  }
@endphp

<nav x-data="{ open: false, userMenu: false }" class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      <!-- Branding -->
      <div class="flex items-center space-x-2">
        <x-application-logo class="w-6 h-6 text-indigo-600" />
        <span class="text-lg font-bold text-gray-800 dark:text-white">
          {{ Auth::user()->isSuperAdmin() ? 'Super Admin' : 'Admin' }}
        </span>
      </div>

      <!-- Desktop links -->
      <div class="hidden md:flex items-center space-x-6">
        <a href="{{ route('dashboard') }}" class="text-sm {{ navClass('dashboard') }}">🏠Tableau de bord</a>
        <a href="{{ route('birth-certificate.index') }}" class="text-sm {{ navClass('birth-certificate.index') }}">🧾Demandes</a>
        @if (Auth::user()->isSuperAdmin())
          <a href="{{ route('users.index') }}" class="text-sm {{ navClass('users.index') }}">👥Utilisateurs</a>
          <a href="{{ route('settings.index') }}" class="text-sm {{ navClass('settings.index') }}">⚙️Paramètres</a>
        @endif
      </div>

      <!-- Notifications + User menu -->
      <div class="flex items-center space-x-4">
        <!-- Notification -->
        <button class="relative text-gray-600 dark:text-gray-300 hover:text-indigo-600">
          🔔
          <span class="absolute top-0 right-0 block w-2 h-2 bg-red-600 rounded-full"></span>
        </button>

        <!-- User dropdown -->
        <div class="relative">
          <button @click="userMenu = !userMenu" class="flex items-center space-x-2 text-gray-800 dark:text-gray-200 hover:text-indigo-600 focus:outline-none">
            👤 <span class="text-sm">{{ Auth::user()->name }}</span>
          </button>

          <div x-show="userMenu"
               x-transition:enter="transition ease-out duration-150"
               x-transition:enter-start="opacity-0 scale-95"
               x-transition:enter-end="opacity-100 scale-100"
               x-transition:leave="transition ease-in duration-100"
               x-transition:leave-start="opacity-100 scale-100"
               x-transition:leave-end="opacity-0 scale-95"
               x-cloak
               @click.away="userMenu = false"
               class="absolute right-0 mt-2 w-40 bg-white dark:bg-gray-800 shadow-lg rounded-md py-2 z-20">
            <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">👤 Profil</a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-100 dark:hover:bg-red-700 dark:text-red-400">
                🔓 Déconnexion
              </button>
            </form>
          </div>
        </div>

        <!-- Mobile toggle -->
        <button @click="open = !open" class="md:hidden text-gray-500 dark:text-gray-300 hover:text-indigo-600">
          <svg class="w-6 h-6" fill="none" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile links -->
  <div x-show="open"
       x-transition:enter="transition ease-out duration-200"
       x-transition:enter-start="opacity-0 transform scale-95"
       x-transition:enter-end="opacity-100 transform scale-100"
       x-transition:leave="transition ease-in duration-150"
       x-transition:leave-start="opacity-100 transform scale-100"
       x-transition:leave-end="opacity-0 transform scale-95"
       x-cloak
       class="md:hidden px-4 pb-4 space-y-2">
    <a href="{{ route('dashboard') }}" class="block text-sm {{ navClass('dashboard') }}">🏠 Tableau de bord</a>
    <a href="{{ route('users.index') }}" class="block text-sm {{ navClass('users.index') }}">👥 Utilisateurs</a>
    @if (Auth::user()->isSuperAdmin())
      <a href="{{ route('settings.index') }}" class="block text-sm {{ navClass('settings.index') }}">⚙️ Paramètres</a>
    @endif
  </div>
</nav>