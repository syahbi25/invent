<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Tailwind CSS v3 CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome CDN for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- AlpineJS for Dropdown Handling -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js" defer></script>

    <!-- Custom Styles -->
    <style>
        /* Animasi Hover pada Menu */
        .nav-link {
            position: relative;
            display: inline-block;
            overflow: hidden;
            transition: transform 0.3s ease, color 0.3s ease;
            padding: 8px 16px;
            border-radius: 8px;
        }

        /* Efek hover pada menu */
        .nav-link:hover {
            color: #fff;
            background-image: linear-gradient(45deg, #ff6a00, #ee0979);
            transform: scale(1.1);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            transition: all 0.4s ease-in-out;
        }

        /* Menambahkan efek border dengan warna gradient */
        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: linear-gradient(45deg, #ff6a00, #ee0979);
            transform: scaleX(0);
            transform-origin: bottom right;
            transition: transform 0.4s ease-out;
            z-index: -1;
        }

        .nav-link:hover::before {
            transform: scaleX(1);
            transform-origin: bottom left;
        }

        /* Style untuk menu yang aktif */
        .nav-link.active {
            color: #fff;
            background-image: linear-gradient(45deg, #00c6ff, #0072ff);
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }

        /* Animasi untuk mobile menu */
        .mobile-menu-link {
            transition: transform 0.3s ease-in-out, color 0.3s ease;
            padding: 10px 20px;
            border-radius: 8px;
        }

        .mobile-menu-link:hover {
            transform: translateX(10px);
            color: #fff;
            background-image: linear-gradient(45deg, #ff6a00, #ee0979);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        /* Styling untuk Dropdown Menu */
        .dropdown-item {
            padding: 12px 16px;
            /* Lebar dan tinggi yang lebih nyaman */
            text-align: left;
            font-size: 1rem;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.2s ease;
            cursor: pointer;
            /* Menambahkan pointer pada item */
        }

        /* Hover efek pada item dropdown */
        .dropdown-item:hover {
            background-color: rgba(59, 130, 246, 0.6);
            /* Warna biru lebih lembut */
            transform: translateX(5px);
            /* Efek geser sedikit */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            /* Menambahkan bayangan */
        }

        /* Menambahkan efek transisi halus pada dropdown */
        .dropdown-menu {
            display: none;
            opacity: 0;
            transform: translateY(10px);
            /* Efek turun */
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        /* Menampilkan dropdown */
        .dropdown-menu.show {
            display: block;
            opacity: 1;
            transform: translateY(0);
            /* Efek muncul */
        }
    </style>
</head>

<body class="bg-gray-100 font-sans antialiased">

    <div id="app" x-data="{ open: false }">

        <!-- Navbar -->
        <nav class="bg-gradient-to-r from-blue-500 via-purple-600 to-pink-500 shadow-lg no-print">
            <div class="max-w-7xl mx-auto px-6 py-4">
                <div class="flex justify-between items-center">
                    <!-- Brand -->
                    <a class="text-2xl font-semibold text-white hover:text-gray-300 transition-all duration-300"
                        href="{{ route('absences.summary') }}">
                        {{ config('app.name', 'laravel') }}
                    </a>

                    <!-- Mobile Menu Button -->
                    <button class="text-white md:hidden" @click="open = !open">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

                    <!-- Links (Desktop) -->
                    <div class="hidden md:flex space-x-8">
                        <ul class="flex items-center space-x-6">
                            @guest
                                @if (Route::has('login'))
                                    <li>
                                        <a class="text-white hover:text-gray-300 nav-link" href="{{ route('login') }} ">
                                            {{ __('Login') }}
                                        </a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li>
                                        <a class="text-white hover:text-gray-300 nav-link" href="{{ route('register') }} ">
                                            {{ __('Register') }}
                                        </a>
                                    </li>
                                @endif
                            @else
                                <li>
                                    <a class="text-white hover:text-gray-300 nav-link {{ request()->routeIs('employees.index') ? 'active' : '' }}"
                                        href="{{ route('employees.index') }}">
                                        {{ __('Karyawan') }}
                                    </a>
                                </li>
                                <li>
                                    <a class="text-white hover:text-gray-300 nav-link {{ request()->routeIs('absences.index') ? 'active' : '' }}"
                                        href="{{ route('absences.index') }}">
                                        {{ __('Absensi') }}
                                    </a>
                                </li>
                                <li>
                                    <a class="text-white hover:text-gray-300 nav-link" href="{{ route('user.index') }}">
                                        {{ __('User') }}
                                    </a>
                                </li>

                                <!-- Dropdown Menu -->
                                <div class="relative inline-block text-left" x-data="{ openDropdown: false }">
                                    <!-- Button untuk membuka dropdown -->
                                    <button type="button" @click="openDropdown = !openDropdown"
                                        class="inline-flex justify-center w-full rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-100">
                                        {{ Auth::user()->name }}
                                        <svg class="w-4 h-4 inline ml-2 transition-transform duration-200"
                                            :class="{ 'rotate-180': openDropdown }" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>

                                    <!-- Dropdown Menu -->
                                    <div x-show="openDropdown" x-transition
                                        class="absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-gradient-to-r from-blue-500 via-purple-600 to-pink-500 text-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                                        <div class="py-1">
                                            <a href="#" class="dropdown-item">
                                                <b>Profile</b>
                                            </a>
                                            <a href="#" class="dropdown-item">
                                                <b>Settings</b>
                                            </a>
                                            <a href="{{ route('logout') }}" class="dropdown-item"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <b>{{ __('Logout') }}</b>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endguest
                        </ul>
                    </div>
                </div>

                <!-- Mobile Links -->
                <div class="md:hidden" x-show="open" @click.away="open = false">
                    <ul class="space-y-4 px-4 pb-4">
                        @guest
                            @if (Route::has('login'))
                                <li>
                                    <a class="block text-white hover:text-gray-300 mobile-menu-link"
                                        href="{{ route('login') }}">
                                        {{ __('Login') }}
                                    </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li>
                                    <a class="block text-white hover:text-gray-300 mobile-menu-link"
                                        href="{{ route('register') }} ">
                                        {{ __('Register') }}
                                    </a>
                                </li>
                            @endif
                        @else
                            <li>
                                <a href="{{ route('logout') }}"
                                    class="block text-white hover:text-gray-300 mobile-menu-link"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="container mx-auto px-4 py-8">
            @yield('content')
        </div>
    </div>

    @yield('styles')
</body>

</html>
