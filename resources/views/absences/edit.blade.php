@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-semibold text-gray mb-6">Edit Absensi</h2>

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
                    <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('absences.update', $absence->id) }}" method="POST" class="space-y-6 mb-4">
                @csrf
                @method('PUT')

                <div hidden>
                    <label class="block text-sm font-medium text-gray">Karyawan:</label>
                    <select name="employee_id"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500"
                        required>
                        <option value="">Pilih Karyawan</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}"
                                {{ $absence->employee_id == $employee->id ? 'selected' : '' }}>
                                {{ $employee->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray">Karyawan:</label>
                    <select
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 p-2 placeholder-gray-400"
                        required disabled>
                        <option value="">Pilih Karyawan</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}"
                                {{ $absence->employee_id == $employee->id ? 'selected' : '' }}>
                                {{ $employee->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray">Tanggal Absensi:</label>
                    <input type="date" name="absence_date" value="{{ $absence->absence_date }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 p-2 placeholder-gray-400"
                        placeholder="Pilih tanggal" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray">Jam Mulai:</label>
                        <input type="time" id="start_time" name="start_time" value="{{ $absence->start_time }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 p-2 placeholder-gray-400"
                            placeholder="HH:MM">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray">Jam Pulang:</label>
                        <input type="time" id="end_time" name="end_time" value="{{ $absence->end_time }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 p-2 placeholder-gray-400"
                            placeholder="HH:MM" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray">Lembur:</label>
                        <input type="number" id="overtime_duration" name="overtime_duration"
                            value="{{ $absence->overtime_duration }}" min="0" placeholder="0"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 p-2 placeholder-gray-400"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray">Alasan:</label>
                        <select name="reason" id="reason"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 p-2 placeholder-gray-400"
                            required>
                            <option value="Pilih Kehadiran" {{ $absence->reason == 'Pilih Kehadiran' ? 'selected' : '' }}>
                                Pilih
                                Kehadiran</option>
                            <option value="Hadir" {{ $absence->reason == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="Sakit" {{ $absence->reason == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                            <option value="Ijin" {{ $absence->reason == 'Ijin' ? 'selected' : '' }}>Ijin</option>
                            <option value="Tanpa Keterangan"
                                {{ $absence->reason == 'Tanpa Keterangan' ? 'selected' : '' }}>
                                Tanpa Keterangan</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-between mt-6">
                    <a href="{{ route('absences.index') }}"
                        class="inline-block px-4 py-2 bg-gradient-to-r from-blue-400 to-blue-600 text-gray font-semibold rounded-md shadow hover:bg-gradient-to-l from-blue-600 to-blue-700 transition duration-300">
                        Kembali
                    </a>
                    <button type="submit"
                        class="w-full md:w-auto px-4 py-2 bg-gradient-to-r from-green-400 to-green-600 text-gray font-semibold rounded-md shadow hover:bg-gradient-to-l from-green-600 to-green-800 transition duration-300">
                        Perbarui
                    </button>
                </div>
            </form>
    </div>
@endsection
