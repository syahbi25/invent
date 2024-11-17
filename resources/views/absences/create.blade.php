@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-semibold text-gray mb-6">Cek Absensi Karyawan</h1>
        <form action="{{ route('absences.showEmployees') }}" method="GET" class="space-y-4">
            @csrf
            <div>
                <label for="date" class="block text-gray font-medium mb-2">Select Date</label>
                <input type="date" name="date" id="date"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    required>
            </div>

            <button type="submit"
                class="w-full md:w-auto px-6 py-2 bg-blue-600 text-gray font-semibold rounded-md shadow hover:bg-blue-700 transition duration-300">
                Check Absences
            </button>
        </form>
    </div>
@endsection
