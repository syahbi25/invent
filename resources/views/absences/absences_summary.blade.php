@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-semibold text-gray mb-6">Absensi Karyawan</h1>

        <!-- Form to select employee, year, month, position, and grade -->
        <form id="filter-form" action="{{ route('absences.summary') }}" method="GET"
            class="grid grid-cols-1 gap-4 md:grid-cols-6">
            @csrf

            <div class="mb-2">
                <label for="employee_id" class="block text-gray font-medium mb-1">Select Employee</label>
                <select name="employee_id" id="employee_id"
                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    onchange="document.getElementById('filter-form').submit();">
                    <option value="">All Employees</option>
                    @foreach ($allEmployees as $employee)
                        <option value="{{ $employee->id }}" {{ request('employee_id') == $employee->id ? 'selected' : '' }}>
                            {{ $employee->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label for="position" class="block text-gray font-medium mb-1">Select Position</label>
                <select name="position" id="position"
                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    onchange="document.getElementById('filter-form').submit();">
                    <option value="">All Positions</option>
                    @foreach ($positions as $position)
                        <option value="{{ $position }}" {{ request('position') == $position ? 'selected' : '' }}>
                            {{ $position }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label for="grade" class="block text-gray font-medium mb-1">Select Grade</label>
                <select name="grade" id="grade"
                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    onchange="document.getElementById('filter-form').submit();">
                    <option value="">All Grades</option>
                    @foreach ($grades as $grade)
                        <option value="{{ $grade }}" {{ request('grade') == $grade ? 'selected' : '' }}>
                            {{ $grade }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-2">
                <label for="month" class="block text-gray font-medium mb-1">Select Month</label>
                <select name="month" id="month"
                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    onchange="document.getElementById('filter-form').submit();">
                    <option value="">All Months</option>
                    @foreach (range(1, 12) as $m)
                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                            {{ date('F', mktime(0, 0, 0, $m)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter for Start Year -->
            <div class="mb-2">
                <label for="start_year" class="block text-gray font-medium mb-1">Start Year</label>
                <select name="start_year" id="start_year"
                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    onchange="document.getElementById('filter-form').submit();">
                    @for ($i = 2020; $i <= date('Y'); $i++)
                        <option value="{{ $i }}" {{ request('start_year') == $i ? 'selected' : '' }}>
                            {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>

            <!-- Filter for End Year -->
            <div class="mb-2">
                <label for="end_year" class="block text-gray font-medium mb-1">End Year</label>
                <select name="end_year" id="end_year"
                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    onchange="document.getElementById('filter-form').submit();">
                    @for ($i = 2020; $i <= date('Y'); $i++)
                        <option value="{{ $i }}" {{ request('end_year') == $i ? 'selected' : '' }}>
                            {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>
        </form>

        <!-- Summary Table -->
        <div class="mt-3 mb-2">
            <h2 class="text-xl font-semibold text-gray">
                Absensi Karyawan ({{ request('month') ? date('F', mktime(0, 0, 0, request('month'))) : 'Tahun' }}
                {{ request('year') }})
            </h2>
        </div>

        @if ($employees->isEmpty())
            <p class="text-gray italic">Tidak ada data absensi.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 text-left bg-white shadow-lg rounded-lg">
                    <thead class="bg-gradient-to-r from-purple-300 to-pink-300 border-b border-gray-300">
                        <tr>
                            <th class="px-4 py-2 text-gray-700 font-medium">Karyawan</th>
                            <th class="px-4 py-2 text-gray-700 font-medium">Hadir</th>
                            <th class="px-4 py-2 text-gray-700 font-medium">Ijin</th>
                            <th class="px-4 py-2 text-gray-700 font-medium">Sakit</th>
                            <th class="px-4 py-2 text-gray-700 font-medium">Tanpa Keterangan</th>
                            <th class="px-4 py-2 text-gray-700 font-medium">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($employees as $employee)
                            <tr class="hover:bg-gray-50 transition duration-300">
                                <td class="px-4 py-2 text-gray-800 font-semibold">{{ $employee->name }}</td>
                                <td class="px-4 py-2 text-gray-800">{{ $employee->total_hadir }}</td>
                                <td class="px-4 py-2 text-gray-800">{{ $employee->total_ijin }}</td>
                                <td class="px-4 py-2 text-gray-800">{{ $employee->total_sakit }}</td>
                                <td class="px-4 py-2 text-gray-800">{{ $employee->total_tanpa_keterangan }}</td>
                                <td class="px-4 py-2 text-gray-800 font-semibold">{{ $employee->total_absences }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
