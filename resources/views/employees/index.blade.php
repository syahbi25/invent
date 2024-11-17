@extends('layouts.app')

@section('title', 'Absences List')

@section('content')
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-3xl font-semibold text-gray">Daftar Karyawan</h2>
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
                    href="{{ route('employees.importexport') }}">Import & Export</a>
                <a class="bg-gradient-to-r from-green-400 to-green-600 text-gray px-4 py-2 rounded-md shadow hover:from-green-500 hover:to-green-700 transition duration-300"
                    href="{{ route('employees.create') }}">Tambah Karyawan</a>
            </div>
        </div>

        <!-- Search Input and Show All Button -->
        <div class="mb-4 flex items-center">
            <form action="{{ route('employees.index') }}" method="GET" class="flex flex-grow mr-2">
                <input type="text" name="search" placeholder="Cari karyawan..."
                    class="border border-gray-300 rounded-md p-2 w-full focus:outline-none focus:ring focus:ring-blue-300 mr-2"
                    value="{{ request('search') }}" />
                <button type="submit"
                    class="bg-gradient-to-r from-blue-400 to-blue-600 text-gray px-4 py-2 rounded-md hover:from-blue-500 hover:to-blue-700 transition duration-300">Cari</button>
            </form>
            <a href="{{ route('employees.index', ['show_all' => true]) }}"
                class="bg-gradient-to-r from-gray-400 to-gray-600 text-gray px-4 py-2 rounded-md hover:from-gray-500 hover:to-gray-700 transition duration-300">Tampilkan
                Semua</a>
        </div>

        @if ($employees->count())
            <!-- Absence Table -->
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300 text-left bg-white shadow-md rounded-lg">
                    <thead class="bg-gradient-to-r from-purple-300 to-pink-300">
                        <tr class="bg-gray-200 text-gray-600">
                            <th class="px-4 py-2 border">ID</th>
                            <th class="px-4 py-2 border">Nama</th>
                            <th class="px-4 py-2 border">Email</th>
                            <th class="px-4 py-2 border">Posisi</th>
                            <th class="px-4 py-2 border">Grade</th>
                            <th class="px-4 py-2 border">Upah Harian</th>
                            <th class="px-4 py-2 border">Upah Lembur</th>
                            <th class="px-4 py-2 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($employees as $employee)
                            <tr class="border-b hover:bg-gray-100 transition duration-300">
                                <td class="px-4 py-2 border">{{ $employee->id }}</td>
                                <td class="px-4 py-2 border">{{ $employee->name }}</td>
                                <td class="px-4 py-2 border">{{ $employee->email }}</td>
                                <td class="px-4 py-2 border">{{ $employee->position }}</td>
                                <td class="px-4 py-2 border">Rp. {{ number_format($employee->grade, 0) }}</td>
                                <td class="px-4 py-2 border">Rp. {{ number_format($employee->fee, 0) }}</td>
                                <td class="px-4 py-2 border">Rp. {{ number_format($employee->overtime_wage, 0) }}</td>
                                <td class="px-4 py-2 border table-actions">
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                        class="flex space-x-2">
                                        <a class="bg-gradient-to-r from-blue-400 to-blue-600 text-gray px-3 py-1 rounded-md hover:from-blue-500 hover:to-blue-700 transition duration-300"
                                            href="{{ route('employees.show', $employee->id) }}">Detail</a>

                                        <a class="bg-gradient-to-r from-green-400 to-green-600 text-gray px-3 py-1 rounded-md hover:from-green-500 hover:to-green-700 transition duration-300"
                                            href="{{ route('employees.salary', $employee->id) }}">Salary</a>

                                        <a class="bg-gradient-to-r from-yellow-400 to-yellow-600 text-gray px-3 py-1 rounded-md hover:from-yellow-500 hover:to-yellow-700 transition duration-300"
                                            href="{{ route('employees.edit', $employee->id) }}">Edit</a>

                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-gradient-to-r from-red-400 to-red-600 text-gray px-3 py-1 rounded-md hover:from-red-500 hover:to-red-700 transition duration-300"
                                            onclick="return confirm('Jika menghapus data, absensi untuk karyawan ini juga akan terhapus semua')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination links -->
            @if (!$showAll && $employees instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <div class="mt-4">
                    {{ $employees->links('vendor.pagination.custom-pagination') }}
                </div>
            @endif
        @else
            <p class="text-center text-red-600 font-semibold">Tidak ada data karyawan.</p>
        @endif
    </div>
@endsection
