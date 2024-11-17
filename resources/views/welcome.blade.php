<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card List with Images and Buttons</title>
    <script src="https://cdn.tailwindcss.com"></script><!-- Font Awesome CDN for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100 py-3">
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

    <!-- Container for the Card List -->
    <div class="max-w-7xl mx-auto mt-4 px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Card 1 -->
            <div
                class="bg-white rounded-lg shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gradient-to-r hover:from-purple-600 hover:to-indigo-600 hover:text-gray">
                <div class="overflow-hidden rounded-t-lg">
                    <img src="https://via.placeholder.com/350x200" alt="Image 1"
                        class="w-full h-48 object-cover transform transition duration-300 hover:scale-110">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4">Card 1 Header</h3>
                    <p class="text-gray-700 mb-4">This is a description for the first card. It features an image with a
                        smooth hover effect.</p>
                    <button
                        class="px-6 py-2 bg-indigo-600 text-gray rounded-full hover:bg-indigo-700 transition duration-300">Learn
                        More</button>
                </div>
            </div>

            <!-- Card 2 -->
            <div
                class="bg-white rounded-lg shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gradient-to-r hover:from-blue-500 hover:to-teal-400 hover:text-gray">
                <div class="overflow-hidden rounded-t-lg">
                    <img src="https://via.placeholder.com/350x200" alt="Image 2"
                        class="w-full h-48 object-cover transform transition duration-300 hover:scale-110">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4">Card 2 Header</h3>
                    <p class="text-gray-700 mb-4">This card features a different style with a cool gradient effect and
                        an interactive image hover effect.</p>
                    <button
                        class="px-6 py-2 bg-teal-500 text-gray rounded-full hover:bg-teal-600 transition duration-300">Explore</button>
                </div>
            </div>

            <!-- Card 3 -->
            <div
                class="bg-white rounded-lg shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gradient-to-r hover:from-green-400 hover:to-blue-500 hover:text-gray">
                <div class="overflow-hidden rounded-t-lg">
                    <img src="https://via.placeholder.com/350x200" alt="Image 3"
                        class="w-full h-48 object-cover transform transition duration-300 hover:scale-110">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4">Card 3 Header</h3>
                    <p class="text-gray-700 mb-4">This is the third card with an engaging image hover effect and a
                        smooth transition for an interactive feel.</p>
                    <button
                        class="px-6 py-2 bg-green-500 text-gray rounded-full hover:bg-green-600 transition duration-300">Read
                        More</button>
                </div>
            </div>

            <!-- Card 4 -->
            <div
                class="bg-white rounded-lg shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gradient-to-r hover:from-red-500 hover:to-yellow-500 hover:text-gray">
                <div class="overflow-hidden rounded-t-lg">
                    <img src="https://via.placeholder.com/350x200" alt="Image 4"
                        class="w-full h-48 object-cover transform transition duration-300 hover:scale-110">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4">Card 4 Header</h3>
                    <p class="text-gray-700 mb-4">This card comes with a vibrant color gradient and a hover effect for
                        both the image and button.</p>
                    <button
                        class="px-6 py-2 bg-red-500 text-gray rounded-full hover:bg-red-600 transition duration-300">Discover</button>
                </div>
            </div>

            <!-- Card 5 -->
            <div
                class="bg-white rounded-lg shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gradient-to-r hover:from-pink-400 hover:to-purple-600 hover:text-gray">
                <div class="overflow-hidden rounded-t-lg">
                    <img src="https://via.placeholder.com/350x200" alt="Image 5"
                        class="w-full h-48 object-cover transform transition duration-300 hover:scale-110">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4">Card 5 Header</h3>
                    <p class="text-gray-700 mb-4">A stylish card with a pink to purple gradient hover effect and a
                        dynamic image scaling effect.</p>
                    <button
                        class="px-6 py-2 bg-pink-500 text-gray rounded-full hover:bg-pink-600 transition duration-300">View
                        More</button>
                </div>
            </div>

            <!-- Card 6 -->
            <div
                class="bg-white rounded-lg shadow-lg transform transition duration-300 hover:scale-105 hover:shadow-xl hover:bg-gradient-to-r hover:from-indigo-500 hover:to-pink-500 hover:text-gray">
                <div class="overflow-hidden rounded-t-lg">
                    <img src="https://via.placeholder.com/350x200" alt="Image 6"
                        class="w-full h-48 object-cover transform transition duration-300 hover:scale-110">
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-4">Card 6 Header</h3>
                    <p class="text-gray-700 mb-4">This card comes with an interactive image that zooms on hover, along
                        with a responsive button for extra action.</p>
                    <button
                        class="px-6 py-2 bg-indigo-500 text-gray rounded-full hover:bg-indigo-600 transition duration-300">Contact
                        Us</button>
                </div>
            </div>

        </div>
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
