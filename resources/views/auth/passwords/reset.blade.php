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
</head>

<body class="bg-gray-100 font-sans antialiased">

    <div id="app" x-data="{ open: false }">
        <main class="py-3">
            <!-- Navbar -->
            <nav
                class="bg-gradient-to-r from-pink-500 via-purple-600 to-indigo-700 p-4 rounded-full flex justify-between items-center shadow-lg">
                <!-- Left Side (Logo) -->
                <div class="flex items-center space-x-4">
                    <div class="bg-white text-gray-800 p-2 rounded-full shadow-md">
                        <span class="text-2xl font-bold">Logo</span>
                    </div>
                </div>

                <!-- Center (Navigation Links) -->
                <div class="hidden md:flex space-x-8 text-gray font-semibold">
                    <a href="/" class="hover:text-pink-200 transition duration-300">Home</a>
                    <a href="{{ route('about') }}" class="hover:text-pink-200 transition duration-300">About</a>
                    <a href="#" class="hover:text-pink-200 transition duration-300">Services</a>
                    <a href="#" class="hover:text-pink-200 transition duration-300">Contact</a>
                </div>

                <!-- Right Side (Button) -->
                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('register') }}">
                        <button
                            class="px-6 py-2 bg-white text-indigo-700 rounded-full hover:bg-indigo-100 transition duration-300">Sign
                            Up</button>
                    </a>

                    <a href="{{ route('login') }}">
                        <button
                            class="px-6 py-2 bg-transparent border-2 border-white text-gray rounded-full hover:bg-white hover:text-indigo-700 transition duration-300">Login</button>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center space-x-2">
                    <button id="hamburger-btn" class="text-gray">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </nav>

            <!-- Mobile Menu (Hidden by default) -->
            <div id="mobile-menu"
                class="md:hidden bg-gradient-to-r from-pink-500 via-purple-600 to-indigo-700 p-4 rounded-b-lg shadow-lg hidden">
                <div class="space-y-4 text-gray font-semibold">
                    <a href="/" class="block hover:text-pink-200 transition duration-300">Home</a>
                    <a href="{{ route('about') }}" class="block hover:text-pink-200 transition duration-300">About</a>
                    <a href="#" class="block hover:text-pink-200 transition duration-300">Services</a>
                    <a href="#" class="block hover:text-pink-200 transition duration-300">Contact</a>
                    <div class="mt-4 space-x-4">
                        <a href="{{ route('register') }}">
                            <button
                                class="px-6 py-2 bg-white text-indigo-700 rounded-full hover:bg-indigo-100 transition duration-300">Sign
                                Up</button>
                        </a>

                        <a href="{{ route('login') }}">
                            <button
                                class="px-6 py-2 bg-transparent border-2 border-white text-gray rounded-full hover:bg-white hover:text-indigo-700 transition duration-300">Login</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="container mx-auto mt-4 px-4">
                <div class="flex justify-center">
                    <div class="w-full max-w-md">
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <div
                                class="bg-gray-800 text-gray text-center py-4 flex justify-center items-center space-x-4">
                                <a href="#">
                                    <h2 class="text-xl font-semibold">{{ __('Reset Password') }}</h2>
                                </a>
                            </div>


                            <div class="p-6">
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf

                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <!-- Email Input -->
                                    <div class="mb-4">
                                        <label for="email"
                                            class="block text-md font-medium text-gray-700">{{ __('Email Address') }}</label>

                                        <div class="mt-1">
                                            <input id="email" type="email"
                                                class="block w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                                                name="email" value="{{ $email ?? old('email') }}" required
                                                autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="text-red-500 text-sm" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Password Input -->
                                    <div class="mb-4">
                                        <label for="password"
                                            class="block text-md font-medium text-gray-700">{{ __('Password') }}</label>

                                        <div class="mt-1">
                                            <input id="password" type="password"
                                                class="block w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                                                name="password" required autocomplete="new-password">

                                            @error('password')
                                                <span class="text-red-500 text-sm" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Confirm Password Input -->
                                    <div class="mb-4">
                                        <label for="password-confirm"
                                            class="block text-md font-medium text-gray-700">{{ __('Confirm Password') }}</label>

                                        <div class="mt-1">
                                            <input id="password-confirm" type="password"
                                                class="block w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="mb-0 flex justify-end">
                                        <button type="submit"
                                            class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            {{ __('Reset Password') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script>
        // JavaScript to toggle the mobile menu
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        hamburgerBtn.addEventListener('click', () => {
            // Toggle the visibility of the mobile menu
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>

</html>
