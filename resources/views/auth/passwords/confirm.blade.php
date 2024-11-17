@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center h-screen bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">Confirm Password</h2>

            <p class="text-gray-600 mb-4 text-center">Please confirm your password before continuing.</p>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-medium mb-2">Password</label>
                    <input id="password" type="password"
                        class="border rounded w-full px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                        name="password" required autocomplete="current-password">
                </div>

                <div class="flex justify-between items-center">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded transition duration-200">
                        Confirm Password
                    </button>

                    <a href="{{ route('password.request') }}" class="text-blue-500 hover:underline text-sm">
                        Forgot Your Password?
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
