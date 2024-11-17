@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center h-screen bg-gray-100">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">Verify Your Email</h2>

            @if (session('resent'))
                <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4 text-center">
                    A new verification link has been sent to your email address.
                </div>
            @endif

            <p class="text-gray-600 mb-4 text-center">Please check your email for a verification link.</p>
            <p class="text-gray-600 mb-6 text-center">If you did not receive the email, click the button below to request
                another.</p>

            <form class="flex justify-center" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded transition duration-200">
                    Resend Verification Email
                </button>
            </form>
        </div>
    </div>
@endsection
