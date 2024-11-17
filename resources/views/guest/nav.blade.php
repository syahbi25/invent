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
