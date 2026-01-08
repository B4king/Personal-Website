<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      dir="{{ app()->getLocale() == 'am' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Zelalem Website')</title>
@if(app()->getLocale() == 'am')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
@else
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@endif
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet">

    <!-- Amharic font -->
    <link href="https://fonts.googleapis.com/css2?family=Abyssinica+SIL&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }

        :lang(am) body {
            font-family: 'Abyssinica SIL', 'Figtree', sans-serif;
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }

        .nav-link.active {
            font-weight: 600;
        }

        footer {
            margin-top: auto;
        }

        /* RTL logical spacing overrides (Bootstrap handles most, but these help) */
        .rtl .dropdown-menu-end {
            right: auto !important;
            left: 0 !important;
        }

        .rtl .dropdown-menu-start {
            right: 0 !important;
            left: auto !important;
        }
    </style>

    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100 {{ app()->getLocale() == 'am' ? 'rtl' : '' }}">
<div class="bg-danger text-white p-2 text-center">
    Current Locale: {{ app()->getLocale() }} | 
    Session Locale: {{ session('locale') }} | 
    Fallback: {{ config('app.fallback_locale') }}
</div>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-user"></i> Zelalem Bekalu
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            {{ __('nav.home') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                            {{ __('nav.about') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ route('services') }}">
                            {{ __('nav.services') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('certifications.*') ? 'active' : '' }}" href="{{ route('certifications.index') }}">
                            {{ __('nav.certifications') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('resume.*') ? 'active' : '' }}" href="{{ route('resume.index') }}">
                            {{ __('nav.resume') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                            {{ __('nav.contact') }}
                        </a>
                    </li>

                    <!-- Language Switcher -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-globe me-1"></i> {{ __('language') }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item {{ app()->getLocale() == 'en' ? 'active' : '' }}"
                                   href="{{ route('language.switch', 'en') }}">
                                    <i class="fas fa-language me-2"></i> {{ __('english') }}
                                    @if(app()->getLocale() == 'en') <i class="fas fa-check float-end"></i> @endif
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item {{ app()->getLocale() == 'am' ? 'active' : '' }}"
                                   href="{{ route('language.switch', 'am') }}">
                                    <i class="fas fa-language me-2"></i> {{ __('amharic') }}
                                    @if(app()->getLocale() == 'am') <i class="fas fa-check float-end"></i> @endif
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Authentication Links -->
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt me-2"></i>{{ __('nav.dashboard') }}</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user me-2"></i>{{ __('nav.profile') }}</a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>{{ __('nav.logout') }}
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">
                            {{ __('nav.login') }}
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-5 mt-5">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-auto">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} {{ __('footer.copyright') }}</p>
            <div class="social-links">
                <a href="https://github.com/B4king" class="text-white mx-3"><i class="fab fa-github"></i></a>
                <a href="#" class="text-white mx-3"><i class="fab fa-linkedin"></i></a>
                <a href="https://x.com/ForeverAmhara" class="text-white mx-3"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>