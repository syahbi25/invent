@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800">User Dashboard</h2>
            <p class="text-gray-600 mt-2">Welcome, {{ Auth::user()->name }}!</p>

            <!-- User Info Section -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-700">User Information</h3>
                <div class="mt-4">
                    <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Joined:</strong> {{ Auth::user()->created_at->format('F d, Y') }}</p>
                </div>
            </div>

            <!-- Settings and Logout Section -->
            <div class="mt-8 flex space-x-4">
                <a href="{{ route('password.confirm') }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition duration-200">
                    Edit Profile
                </a>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition duration-200">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection
