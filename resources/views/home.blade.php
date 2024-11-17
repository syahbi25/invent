@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <div class="flex justify-center">
            <div class="w-full max-w-md">
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="bg-gray-800 text-gray text-center py-4">
                        <h2 class="text-xl font-semibold">{{ __('Dashboard') }}</h2>
                    </div>

                    <div class="p-6">
                        @if (session('status'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4"
                                role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p class="text-gray-700">{{ __('You are logged in!') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
