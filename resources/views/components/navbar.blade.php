
<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top border-bottom shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="{{ route('ask') }}">ADA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
      aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarMenu">
      <ul class="navbar-nav ms-auto mb-1 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('ask') ? 'active fw-bold text-primary' : '' }}" href="{{ route('ask') }}">
            Faire une demande
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('search') ? 'active fw-bold text-primary' : '' }}" href="{{ route('search') }}">
            Rechercher un document
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('tracking') ? 'active fw-bold text-primary' : '' }}" href="{{ route('tracking') }}">
            Suivre un document
          </a>
        </li>

      </ul>
    </div>
  </div>
</nav>
