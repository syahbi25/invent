@extends('layouts.app')

@section('title', 'Gaji ' . $employee->name)

@section('content')
    <div class="mt-4 p-6 bg-white shadow-lg rounded-lg max-w-md mx-auto">
        <h2 class="text-2xl font-semibold mb-4 text-center">Salary {{ $employee->name }}</h2>

        <div class="grid grid-cols-2 gap-2 mb-4">
            <div>
                <p><strong>Posisi:</strong> {{ $employee->position }}</p>
            </div>
            <div>
                <p><strong>Grade:</strong> Rp. {{ number_format($employee->grade, 0) }}</p>
            </div>
            <div>
                <p><strong>Fee:</strong> Rp. {{ number_format($employee->fee, 0) }}</p>
            </div>
            <div>
                <p><strong>Lembur:</strong> Rp. {{ number_format($employee->overtime_wage, 0) }}</p>
            </div>
        </div>

        <h4 class="mt-3 text-lg font-semibold">Kehadiran:</h4>
        <div class="space-y-2">
            @foreach ($absencesWithSalary as $absence)
                <div class="bg-gray-100 p-3 rounded-lg shadow-sm">
                    <div class="flex justify-between text-sm">
                        <div>
                            <p><strong>{{ $absence['day_name'] }}, {{ $absence['absence_date'] }}</strong></p>
                            <p class="text-gray-600">Jam kerja: {{ $absence['start_time'] }} - {{ $absence['end_time'] }}</p>
                            <p class="text-gray-700"><strong>Upah Harian:</strong> Rp.
                                {{ number_format($absence['regular_salary'], 0) }}</p>
                        </div>
                        <div class="text-right">
                            <div class="flex justify-between text-sm">
                                <div>
                                    <p class="text-gray-700"><strong>Lembur:</strong> {{ $absence['overtime_duration'] }}
                                        Jam</p>
                                </div>
                                <div class="text-right">
                                    <p>
                                        @if ($absence['is_paid'])
                                            <span class="bg-green-200 text-green-800 px-1 py-1 rounded text-xs">Paid</span>
                                        @else
                                            <span class="bg-red-200 text-red-800 px-1 py-1 rounded text-xs">Unpaid</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <p class="text-gray-700"><strong>Upah Lembur:</strong> Rp.
                                {{ number_format($absence['overtime_salary'], 0) }}</p>
                            <p class="text-gray-700"><strong>Total Harian:</strong> Rp.
                                {{ number_format($absence['total_salary'], 0) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <h4 class="mt-3 text-lg font-semibold">Total Salary: Rp. {{ number_format($totalSalary, 0) }}</h4>
    </div>

    @if (!empty($absencesWithSalary))
        <div class="flex justify-between mt-4 max-w-md mx-auto no-print">
            <div>
                <form action="{{ route('employees.markAllAsPaid', $employee->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-blue-500 text-gray py-2 px-4 rounded shadow hover:bg-blue-600 transition duration-300">Mark
                        as Paid</button>
                </form>
            </div>
            <div>
                <form action="{{ route('employees.markAllAsPayment', $employee->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-green-500 text-gray py-2 px-4 rounded shadow hover:bg-green-600 transition duration-300">Done</button>
                </form>
            </div>
        </div>
    @endif

    <div class="max-w-md mx-auto mt-3 no-print">
        <a href="{{ route('employees.index') }}"
            class="inline-block bg-indigo-500 text-gray py-2 px-4 rounded shadow hover:bg-indigo-600 transition duration-300">Back
        </a>
        <button onclick="window.print()"
            class="mt-2 bg-gray-500 text-gray py-2 px-4 rounded shadow hover:bg-gray-600 transition duration-300">Print</button>
    </div>

    @if (session('success'))
        <script>
            window.addEventListener('load', function() {
                window.print();
            });
        </script>
    @endif
@endsection

@section('styles')
    <style>
        @media print {
            body {
                width: 6in;
                /* Size for small envelope */
                height: auto;
                /* Adjust height if necessary */
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
                /* Set a clean font for printing */
                font-size: 12pt;
                /* Adjust font size for better readability */
                color: #000;
                /* Black text for clarity */
            }

            .no-print {
                display: none;
                /* Hide elements you don’t want to print */
            }

            h2,
            h4 {
                page-break-after: avoid;
                /* Prevent page breaks after headers */
            }

            .bg-gray-100 {
                background-color: #f7fafc !important;
                /* Light gray background */
            }

            .space-y-2 {
                margin-bottom: 0.5rem;
                /* Control spacing between items */
            }

            .rounded-lg {
                border: 1px solid #ccc;
                /* Add a border for separation */
                padding: 1rem;
                /* Add some padding */
            }

            p {
                margin: 0;
                /* Remove margin for paragraphs to avoid extra spacing */
            }

            /* Hide all buttons and links from print */
            button,
            a {
                display: none;
                /* Hide buttons and links in print */
            }
        }
    </style>
@endsection
