<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylish Card List with Images and Animations</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome CDN for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gradient-to-b from-purple-200 via-pink-100 to-indigo-200 py-6">
    <!-- Navbar -->
    <nav
        class="bg-gradient-to-r from-pink-500 via-purple-600 to-indigo-700 p-4 rounded-full flex justify-between items-center shadow-lg mx-4">
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

    <!-- Container for the Card List -->
    <div class="max-w-7xl mx-auto mt-12 px-6">
        <!-- About Us Section -->
        <div
            class="text-center bg-white rounded-lg p-10 shadow-xl mb-12 relative overflow-hidden transform hover:shadow-2xl transition duration-300">
            <div class="absolute inset-0 bg-gradient-to-r from-pink-500 via-purple-600 to-indigo-700 opacity-10"></div>
            <h1 class="text-5xl font-extrabold text-gray-800 mb-6 relative">About Us</h1>
            <p class="text-lg text-gray-600 relative">We are dedicated to providing the best services and products.
                Learn more about us below.</p>
        </div>

        <!-- About Content with Image and Text -->
        <div class="flex flex-col md:flex-row items-center gap-12 mb-16">
            <!-- Image -->
            <div class="w-full md:w-1/2 relative">
                <div class="relative transition duration-300 transform hover:scale-105">
                    <img src="https://via.placeholder.com/500" alt="Our Team" class="rounded-lg shadow-2xl w-full">
                    <div
                        class="absolute inset-0 bg-gradient-to-b from-transparent via-indigo-700 to-indigo-900 opacity-30 rounded-lg">
                    </div>
                </div>
            </div>

            <!-- Description Text -->
            <div class="w-full md:w-1/2 text-gray-700 space-y-8">
                <div class="relative overflow-hidden">
                    <h2 class="text-4xl font-semibold mb-4">Who We Are</h2>
                    <p class="leading-relaxed">We are a team dedicated to providing the best experience for our users.
                        With years of experience, we are committed to continuously improving our services.</p>
                </div>
                <div class="relative overflow-hidden">
                    <h2 class="text-4xl font-semibold mb-4">Our Mission</h2>
                    <p class="leading-relaxed">Our mission is to help people achieve their goals by providing quality
                        products and services. We believe that every customer is our top priority.</p>
                </div>
            </div>
        </div>

        <!-- Our Team Section -->
        <div
            class="text-center bg-white rounded-lg p-10 shadow-xl mb-12 relative overflow-hidden transform hover:shadow-2xl transition duration-300">
            <div class="absolute inset-0 bg-gradient-to-r from-pink-500 via-purple-600 to-indigo-700 opacity-10"></div>
            <h2 class="text-5xl font-extrabold text-gray-800 mb-6">Our Team</h2>
        </div>

        <!-- Team Members Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 px-4">
            <!-- Team Member Card -->
            <div
                class="relative bg-white p-8 rounded-lg shadow-lg transition duration-300 hover:shadow-2xl transform hover:scale-105">
                <img src="https://via.placeholder.com/150" alt="Team Member"
                    class="w-32 h-32 mx-auto rounded-full border-4 border-indigo-500 -mt-20 mb-6 transform hover:rotate-3 transition">
                <h3 class="text-2xl font-bold text-gray-800">John Doe</h3>
                <p class="text-gray-600">CEO</p>
                <p class="mt-4 text-gray-600 leading-relaxed">John brings visionary leadership with a focus on achieving
                    exceptional results for clients.</p>
            </div>

            <div
                class="relative bg-white p-8 rounded-lg shadow-lg transition duration-300 hover:shadow-2xl transform hover:scale-105">
                <img src="https://via.placeholder.com/150" alt="Team Member"
                    class="w-32 h-32 mx-auto rounded-full border-4 border-indigo-500 -mt-20 mb-6 transform hover:rotate-3 transition">
                <h3 class="text-2xl font-bold text-gray-800">Jane Smith</h3>
                <p class="text-gray-600">CTO</p>
                <p class="mt-4 text-gray-600 leading-relaxed">Jane heads the technology team, driving innovative
                    solutions and technical excellence.</p>
            </div>

            <div
                class="relative bg-white p-8 rounded-lg shadow-lg transition duration-300 hover:shadow-2xl transform hover:scale-105">
                <img src="https://via.placeholder.com/150" alt="Team Member"
                    class="w-32 h-32 mx-auto rounded-full border-4 border-indigo-500 -mt-20 mb-6 transform hover:rotate-3 transition">
                <h3 class="text-2xl font-bold text-gray-800">Emily Johnson</h3>
                <p class="text-gray-600">CFO</p>
                <p class="mt-4 text-gray-600 leading-relaxed">Emily manages financial strategy with a dedication to
                    maintaining long-term stability and growth.</p>
            </div>
        </div>
    </div>

    <script>
        // JavaScript to toggle the mobile menu
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        hamburgerBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>

</html>
