

<nav x-data="{ open: false }" class="bg-white shadow-sm sticky top-0 border-b z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">
      
      <!-- Logo -->
      <a href="{{ route('ask') }}" class="text-xl font-bold text-gray-700">ADA</a>

      <!-- Toggler (Mobile) -->
      <button @click="open = !open" class="md:hidden text-gray-700 focus:outline-none">
        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"></path>
          <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>

      <!-- Menu (Desktop) -->
      <ul class="hidden md:flex space-x-4 items-center">
        <li>
          <a href="{{ route('ask') }}"
             class="text-gray-700 hover:text-blue-600 font-medium {{ request()->routeIs('ask') ? 'font-bold text-blue-600' : '' }}">
            Faire une demande
          </a>
        </li>
        <li>
          <a href="{{ route('search') }}"
             class="text-gray-700 hover:text-blue-600 font-medium {{ request()->routeIs('search') ? 'font-bold text-blue-600' : '' }}">
            Rechercher un document
          </a>
        </li>
        <li>
          <a href="{{ route('tracking') }}"
             class="text-gray-700 hover:text-blue-600 font-medium {{ request()->routeIs('tracking') ? 'font-bold text-blue-600' : '' }}">
            Suivre un document
          </a>
        </li>
      </ul>
    </div>

    <!-- Menu (Mobile) -->
    <div x-show="open" x-transition class="md:hidden mt-2">
      <ul class="space-y-2">
        <li>
          <a @click="open = false" href="{{ route('ask') }}"
             class="block text-gray-700 hover:text-blue-600 font-medium {{ request()->routeIs('ask') ? 'font-bold text-blue-600' : '' }}">
            Faire une demande
          </a>
        </li>
        <li>
          <a @click="open = false" href="{{ route('search') }}"
             class="block text-gray-700 hover:text-blue-600 font-medium {{ request()->routeIs('search') ? 'font-bold text-blue-600' : '' }}">
            Rechercher un document
          </a>
        </li>
        <li>
          <a @click="open = false" href="{{ route('tracking') }}"
             class="block text-gray-700 hover:text-blue-600 font-medium {{ request()->routeIs('tracking') ? 'font-bold text-blue-600' : '' }}">
            Suivre un document
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>