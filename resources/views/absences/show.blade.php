@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <div class="bg-gray-200 px-4 py-2 font-semibold">
                Absence of {{ $absence->employee->name }}
            </div>
            <div class="p-4 shadow-inner rounded-lg">
                <p class="mb-2"><strong>Date:</strong> {{ $absence->absence_date }}</p>
                <p class="mb-2"><strong>Kehadiran:</strong> {{ $absence->reason }}</p>
                <p class="mb-2"><strong>Mulai Kerja:</strong> {{ $absence->start_time }}</p>
                <p class="mb-2"><strong>Selesai Kerja:</strong> {{ $absence->end_time }}</p>
                <p class="mb-2"><strong>Lama Kerja:</strong> {{ $absence->duration }}</p>
                <p class="mb-2"><strong>lembur:</strong> {{ $absence->overtime_duration }}</p>
                <a href="{{ route('absences.index') }}"
                    class="inline-block px-4 py-2 bg-gradient-to-r from-blue-400 to-blue-600 text-gray font-semibold rounded-md shadow hover:bg-gradient-to-l from-blue-600 to-blue-700 transition duration-300">
                    Back
                </a>
            </div>
        </div>
    </div>
@endsection
