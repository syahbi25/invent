@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-semibold mb-4">Absensi Tanggal {{ $selectedDate }}</h1>
        <form action="{{ route('absences.store') }}" method="POST">
            @csrf
            <input type="hidden" name="absence_date" value="{{ $selectedDate }}">

            <div class="mb-4">
                <input type="text" id="search" placeholder="Cari nama, Posisi, Jabatan karyawan..."
                    class="border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 w-full p-2"
                    onkeyup="filterTable()">
            </div>

            <div class="form-group">
                @if ($employees->isEmpty())
                    <p class="text-yellow-600 font-medium text-center">Semua karyawan telah diabsen untuk tanggal ini.</p>
                    <div class="text-center mt-4">
                        <a href="{{ route('absences.index') }}"
                            class="inline-block px-4 py-2 bg-gradient-to-r from-blue-400 to-blue-600 text-gray font-semibold rounded-md shadow hover:bg-gradient-to-l from-blue-600 to-blue-700 transition duration-300">Kembali</a>
                    </div>
                @else
                    <table class="min-w-full bg-white border border-gray-300 rounded-lg" id="employeeTable">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600">
                                <th class="px-4 py-2">Pilih</th>
                                <th class="px-4 py-2">Nama Karyawan</th>
                                <th class="px-4 py-2">Position</th>
                                <th class="px-4 py-2">Grade</th>
                                <th class="px-4 py-2">Jam Mulai</th>
                                <th class="px-4 py-2">Jam Pulang</th>
                                <th class="px-4 py-2">Lembur (Jam)</th>
                                <th class="px-4 py-2">Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr class="border-b employee-row">
                                    <!-- Checkbox for selecting employee -->
                                    <td class="px-4 py-2">
                                        <input type="checkbox" name="employee_id[]" value="{{ $employee->id }}"
                                            id="employee-{{ $employee->id }}">
                                    </td>

                                    <!-- Employee name -->
                                    <td class="px-4 py-2">
                                        <label for="employee-{{ $employee->id }}"
                                            class="font-medium">{{ $employee->name }}</label>
                                    </td>
                                    <td class="px-4 py-2">
                                        <label for="employee-{{ $employee->id }}"
                                            class="font-medium">{{ $employee->position }}</label>
                                    </td>
                                    <td class="px-4 py-2">
                                        <label for="employee-{{ $employee->id }}" class="font-medium">Rp.
                                            {{ number_format($employee->grade) }}</label>
                                    </td>

                                    <!-- Start time input -->
                                    <td class="px-4 py-2">
                                        <input type="time" id="start_time_{{ $employee->id }}"
                                            name="start_time[{{ $employee->id }}]"
                                            value="{{ old('start_time.' . $employee->id, '07:00') }}"
                                            class="border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500">
                                    </td>

                                    <!-- End time input -->
                                    <td class="px-4 py-2">
                                        <input type="time" id="end_time_{{ $employee->id }}"
                                            name="end_time[{{ $employee->id }}]"
                                            value="{{ old('end_time.' . $employee->id, '16:00') }}"
                                            class="border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500">
                                    </td>

                                    <!-- Overtime input -->
                                    <td class="px-4 py-2">
                                        <input type="number" id="overtime_duration_{{ $employee->id }}"
                                            name="overtime_duration[{{ $employee->id }}]"
                                            value="{{ old('overtime_duration.' . $employee->id) }}" min="0"
                                            placeholder="0"
                                            class="border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500">
                                    </td>

                                    <!-- Reason select -->
                                    <td class="px-4 py-2">
                                        <select name="reason[{{ $employee->id }}]" id="reason_{{ $employee->id }}"
                                            required
                                            class="border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500">
                                            <option value="Pilih Kehadiran">Pilih Kehadiran</option>
                                            <option value="Hadir">Hadir</option>
                                            <option value="Sakit">Sakit</option>
                                            <option value="Ijin">Ijin</option>
                                            <option value="Tanpa Keterangan">Tanpa Keterangan</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            @if (!$employees->isEmpty())
                <div class="form-group text-center mt-6">
                    <button type="submit"
                        class="px-4 py-2 bg-gradient-to-r from-green-400 to-green-600 text-gray font-semibold rounded-md shadow hover:bg-gradient-to-l from-green-600 to-green-800 transition duration-300">Simpan</button>
                </div>
            @endif
        </form>
    </div>

    <script>
        function filterTable() {
            const searchInput = document.getElementById('search').value.toLowerCase();
            const rows = document.querySelectorAll('.employee-row');

            rows.forEach(row => {
                const nameCell = row.cells[1].textContent.toLowerCase();
                const positionCell = row.cells[2].textContent.toLowerCase();
                const gradeCell = row.cells[3].textContent.toLowerCase();

                if (nameCell.includes(searchInput) || positionCell.includes(searchInput) || gradeCell.includes(
                        searchInput)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
@endsection
