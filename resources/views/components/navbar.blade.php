
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top border-bottom shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="{{ route('demande') }}">ADA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
      aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMenu">
      <ul class="navbar-nav ms-auto mb-1 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('demande') ? 'active fw-bold text-primary' : '' }}" href="{{ route('demande') }}">
            Faire une demande
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('recherche') ? 'active fw-bold text-primary' : '' }}" href="{{ route('recherche') }}">
            Rechercher un document
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('suivi') ? 'active fw-bold text-primary' : '' }}" href="{{ route('suivi') }}">
            Suivre un document
          </a>
        </li>

      </ul>
    </div>
  </div>
</nav>
