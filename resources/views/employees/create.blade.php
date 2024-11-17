@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold text-gray mb-4 text-center">Tambah Karyawan</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($employee) ? route('employees.update', $employee->id) : route('employees.store') }}"
            method="POST">
            @csrf
            @if (isset($employee))
                @method('PUT')
            @endif

            <!-- Row 1: Name, Email, Position -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray">Name</label>
                    <input type="text" name="name" id="name"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 p-2"
                        value="{{ old('name', $employee->name ?? '') }}" required>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray">Email</label>
                    <input type="email" name="email" id="email"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 p-2"
                        value="{{ old('email', $employee->email ?? '') }}" required>
                </div>

                <div>
                    <label for="position" class="block text-sm font-medium text-gray">Position</label>
                    <input type="text" name="position" id="position"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 p-2"
                        value="{{ old('position', $employee->position ?? '') }}" required>
                </div>
            </div>

            <!-- Row 2: Grade, Fee, Overtime Wage -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                <div>
                    <label for="grade" class="block text-sm font-medium text-gray">Grade</label>
                    <input type="number" name="grade" id="grade"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 p-2"
                        value="{{ old('grade', $employee->grade ?? '') }}" step="1000" placeholder="Rp. 0" required>
                </div>

                <div>
                    <label for="fee" class="block text-sm font-medium text-gray">Fee (Salary)</label>
                    <input type="number" name="fee" id="fee"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 p-2"
                        value="{{ old('fee', $employee->fee ?? '') }}" step="1000" placeholder="Rp. 0" required>
                </div>

                <div>
                    <label for="overtime_wage" class="block text-sm font-medium text-gray">Overtime Wage</label>
                    <input type="number" name="overtime_wage" id="overtime_wage"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 p-2"
                        value="{{ old('overtime_wage', $employee->overtime_wage ?? '') }}" step="1000"
                        placeholder="Rp. 0" required>
                </div>
            </div>

            <button type="submit"
                class="mt-4 bg-gradient-to-r from-blue-400 to-blue-600 text-gray px-4 py-2 rounded-md shadow-lg hover:from-blue-500 hover:to-blue-700 transition duration-300">
                {{ isset($employee) ? 'Update Employee' : 'Create Employee' }}
            </button>
        </form>
    </div>
@endsection
