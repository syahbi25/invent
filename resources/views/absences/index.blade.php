@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-semibold text-gray">Daftar Absensi</h2>

            <div class="flex space-x-2">
                <!-- Delete All Employees Button -->
                <form action="{{ route('employees.deleteAll') }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete all employees? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-6 py-2 bg-gradient-to-r from-red-400 to-red-600 text-gray font-semibold rounded-md shadow hover:bg-red-700 transition duration-300">
                        Delete All
                    </button>
                </form>

                <a class="bg-gradient-to-r from-yellow-400 to-yellow-600 text-gray px-4 py-2 rounded-md shadow hover:from-yellow-500 hover:to-yellow-700 transition duration-300"
                    href="{{ route('absences.importexport') }}">Import & Export</a>
                <!-- Date Selection and Submit Button Inline Form Right-Aligned -->
                <form action="{{ route('absences.showEmployees') }}" method="GET" class="flex items-center space-x-2">
                    @csrf
                    <input type="date" name="date" id="date"
                        class="w-full md:w-auto px-4 py-1.5 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required>

                    <button type="submit"
                        class="px-6 py-2 bg-gradient-to-r from-green-400 to-green-600 text-gray font-semibold rounded-md shadow hover:bg-gradient-to-l from-green-600 to-green-800 transition duration-300">
                        Cek Absen
                    </button>
                </form>
            </div>
        </div>

        @if ($absences->count())
            <!-- Absence Table -->
            <div class="overflow-x-auto">
                <!-- Search Form -->
                <form action="{{ route('absences.index') }}" method="GET" class="mb-4">
                    <div class="flex items-center mb-6 space-x-4">
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="w-full px-4 py-1.5 border border-gray-300 rounded-md shadow-sm"
                            placeholder="Search by name, position, or date...">
                        <button type="submit"
                            class="bg-gradient-to-r from-blue-400 to-blue-600 text-gray px-4 py-2 rounded-md hover:bg-gradient-to-l from-blue-600 to-blue-800 transition duration-300">
                            Cari
                        </button>
                    </div>
                </form>

                <table class="min-w-full border border-gray-300 text-left bg-white shadow-lg rounded-lg">
                    <thead class="bg-gradient-to-r from-purple-300 to-pink-300 border-b border-gray-300">
                        <tr>
                            <th class="px-4 py-2 text-gray-700 font-medium">ID</th>
                            <th class="px-4 py-2 text-gray-700 font-medium">Karyawan</th>
                            <th class="px-4 py-2 text-gray-700 font-medium">Position</th>
                            <th class="px-4 py-2 text-gray-700 font-medium">Grade</th>
                            <th class="px-4 py-2 text-gray-700 font-medium">Tanggal</th>
                            <th class="px-4 py-2 text-gray-700 font-medium">Mulai Kerja</th>
                            <th class="px-4 py-2 text-gray-700 font-medium">Pulang Kerja</th>
                            <th class="px-4 py-2 text-gray-700 font-medium">Reason</th>
                            <th class="px-4 py-2 text-gray-700 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($absences as $absence)
                            <tr class="hover:bg-gray-50 transition duration-300">
                                <td class="px-4 py-2 text-gray-800">{{ $absence->id }}</td>
                                <td class="px-4 py-2 text-gray-800">{{ $absence->employee->name }}</td>
                                <td class="px-4 py-2 text-gray-800">{{ $absence->employee->position }}</td>
                                <td class="px-4 py-2 text-gray-800">Rp. {{ number_format($absence->employee->grade) }}</td>
                                <td class="px-4 py-2 text-gray-800">{{ $absence->absence_date }}</td>
                                <td class="px-4 py-2 text-gray-800">{{ $absence->start_time }}</td>
                                <td class="px-4 py-2 text-gray-800">{{ $absence->end_time }}</td>
                                <td class="px-4 py-2 text-gray-800">{{ $absence->reason }}</td>
                                <td class="px-4 py-2 flex space-x-2">
                                    <a href="{{ route('absences.show', $absence->id) }}"
                                        class="px-2 py-1 bg-gradient-to-r from-blue-500 to-blue-600 text-gray rounded-md text-sm hover:bg-gradient-to-l from-blue-600 to-blue-700 transition duration-300">Detail</a>
                                    <a href="{{ route('absences.edit', $absence->id) }}"
                                        class="px-2 py-1 bg-gradient-to-r from-yellow-400 to-yellow-500 text-gray rounded-md text-sm hover:bg-gradient-to-l from-yellow-500 to-yellow-600 transition duration-300">Edit</a>
                                    <form action="{{ route('absences.destroy', $absence->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-2 py-1 bg-gradient-to-r from-red-400 to-red-600 text-gray rounded-md text-sm hover:bg-gradient-to-l from-red-600 to-red-700 transition duration-300">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination links -->
            <div class="mt-6">
                {{ $absences->links('vendor.pagination.custom-pagination') }}
            </div>
        @else
            <p class="text-gray-600 italic">Tidak ada data absensi.</p>
        @endif
    </div>
@endsection
