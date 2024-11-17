@extends('layouts.app')

@section('title', 'Gaji ' . $employee->name)

@section('content')
    <div class="mt-4 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-semibold mb-4 text-center">Salary {{ $employee->name }}</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
            <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                <p><strong>Posisi:</strong> {{ $employee->position }}</p>
            </div>
            <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                <p><strong>Grade:</strong> Rp. {{ number_format($employee->grade, 0) }}</p>
            </div>
            <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                <p><strong>Fee:</strong> Rp. {{ number_format($employee->fee, 0) }}</p>
            </div>
            <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                <p><strong>Lembur:</strong> Rp. {{ number_format($employee->overtime_wage, 0) }}</p>
            </div>
        </div>

        <h4 class="mt-3 text-lg font-semibold">Absences:</h4>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                <thead>
                    <tr class="bg-gray-200 text-gray-700">
                        <th class="p-4 text-left text-sm font-semibold">Date</th>
                        <th class="p-4 text-left text-sm font-semibold">Working Hours</th>
                        <th class="p-4 text-left text-sm font-semibold">Daily Wage</th>
                        <th class="p-4 text-left text-sm font-semibold">Overtime</th>
                        <th class="p-4 text-left text-sm font-semibold">Overtime Wage</th>
                        <th class="p-4 text-left text-sm font-semibold">Total</th>
                        <th class="p-4 text-left text-sm font-semibold">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($absencesWithSalary as $absence)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="p-4 text-sm">
                                <strong>{{ $absence['day_name'] }}, {{ $absence['absence_date'] }}</strong>
                            </td>
                            <td class="p-4 text-sm text-gray-600">
                                {{ $absence['start_time'] }} - {{ $absence['end_time'] }}
                            </td>
                            <td class="p-4 text-sm text-gray-700">
                                Rp. {{ number_format($absence['regular_salary'], 0) }}
                            </td>
                            <td class="p-4 text-sm text-gray-700">
                                {{ $absence['overtime_duration'] }}
                                @if (!empty($absence['overtime_duration']))
                                    Jam
                                @endif
                            </td>
                            <td class="p-4 text-sm text-gray-700">
                                Rp. {{ number_format($absence['overtime_salary'], 0) }}
                            </td>
                            <td class="p-4 text-sm text-gray-700">
                                Rp. {{ number_format($absence['total_salary'], 0) }}
                            </td>
                            <td class="p-4 text-sm">
                                @if ($absence['is_paid'])
                                    <span class="bg-green-200 text-green-800 px-2 py-1 rounded text-xs">Paid</span>
                                @else
                                    <span class="bg-red-200 text-red-800 px-2 py-1 rounded text-xs">Unpaid</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h4 class="mt-3 text-lg font-semibold">Total Salary: Rp. {{ number_format($totalSalary, 0) }}</h4>
        @if (!empty($absencesWithSalary))
            <div class="flex items-center justify-between mt-4 no-print">
                <div class="flex items-center gap-x-4">

                    <a href="{{ route('employees.index') }}"
                        class="inline-block bg-indigo-500 text-gray py-2 px-4 rounded shadow hover:bg-indigo-600 transition duration-300">Back
                    </a>
                    <form action="{{ route('employees.markAllAsPayment', $employee->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="bg-green-500 text-gray py-2 px-4 rounded shadow hover:bg-green-600 transition duration-300">Done</button>
                    </form>
                </div>
            </div>
        @endif

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
                width: 100%;
                /* Make full width for printing */
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
