<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'ADA - Application')</title> <!-- Titre par défaut -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light d-flex flex-column min-vh-100">

    {{-- Navbar réutilisable --}}
    <x-navbar />


    {{-- Contenu dynamique --}}
    <main class="container py-5">
        @yield('content')
    </main>

    {{-- Footer optionnel --}}
    <footer class="bg-light text-center py-3 mt-auto border-top">
        <small>&copy; {{ date('Y') }} ADA. Tous droits réservés.</small>
    </footer>

</body>
</html>
