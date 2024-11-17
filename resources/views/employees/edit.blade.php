@extends('layouts.app')

@section('content')

    <div class="container mx-auto p-6 bg-white bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Edit Karyawan</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('employees.store') }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Row 1: Name, Email, Position -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="name" class="block font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ old('name', $employee->name ?? '') }}" required>
                </div>

                <div>
                    <label for="email" class="block font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ old('email', $employee->email ?? '') }}" required>
                </div>

                <div>
                    <label for="position" class="block font-medium text-gray-700">Position</label>
                    <input type="text" name="position" id="position"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ old('position', $employee->position ?? '') }}" required>
                </div>
            </div>

            <!-- Row 2: Grade, Fee, Overtime Wage -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                    <label for="grade" class="block font-medium text-gray-700">Grade</label>
                    <input type="text" name="grade" id="grade"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        value="Rp. {{ number_format(old('grade', $employee->grade ?? 0), 0, ',', '.') }}" required>
                </div>

                <div>
                    <label for="fee" class="block font-medium text-gray-700">Fee (Salary)</label>
                    <input type="number" name="fee" id="fee"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ old('fee', $employee->fee ?? 0) }}" step="0.01" required>
                </div>

                <div>
                    <label for="overtime_wage" class="block font-medium text-gray-700">Overtime Wage</label>
                    <input type="number" name="overtime_wage" id="overtime_wage"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        value="{{ old('overtime_wage', $employee->overtime_wage ?? 0) }}" step="0.01" required>
                </div>
            </div>
            <div class="max-w-md mx-auto mt-5 no-print">
                <a href="{{ route('employees.index') }}"
                    class="inline-block bg-indigo-500 text-gray py-2 px-4 rounded shadow hover:bg-indigo-600 transition duration-300">Back
                </a>
                <button type="submit"
                    class="inline-block bg-yellow-500 text-gray py-2 px-4 rounded shadow hover:bg-yellow-600 transition duration-300">
                    {{ isset($employee) ? 'Update Employee' : 'Create Employee' }}
                </button>
            </div>
        </form>

        <!-- JavaScript to Format Rupiah -->
        <script>
            document.getElementById('grade').addEventListener('input', function(e) {
                let value = e.target.value.replace(/[^\d]/g, ''); // Remove any non-digit characters
                if (value) {
                    e.target.value = 'Rp. ' + parseInt(value).toLocaleString('id-ID'); // Format as Rupiah
                }
            });
        </script>
    </div>
@endsection
