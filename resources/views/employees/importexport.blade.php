@extends('layouts.app')

@section('title', 'Import & Export')

@section('content')
    <!-- Import & Export Section -->
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold text-gray mb-4 text-center">Import & Export Excel File</h1>
        <p class="text-sm text-gray text-center mb-6">Use export to download a sample template for data input</p>

        <form action="{{ route('employees.import') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Drag & Drop Area -->
            <div id="drop-area" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center mb-4">
                <label for="file" class="block text-gray-700 font-medium mb-2">Upload File</label>

                <!-- Hidden File Input -->
                <input type="file" name="file" id="file" class="hidden" accept=".xls,.xlsx,.csv" required>

                <!-- Custom Drag & Drop Instructions -->
                <p class="text-gray-600 mb-3">Drag & drop your file here, or</p>
                <label for="file"
                    class="inline-block cursor-pointer px-4 py-2 bg-indigo-600 text-gray rounded-full font-medium hover:bg-indigo-700 transition duration-300">
                    Choose File
                </label>
                <p id="file-chosen" class="mt-3 text-gray-600">No file chosen</p>
            </div>

            <div class="flex space-x-4 w-full mt-6">
                <button type="submit"
                    class="w-1/2 bg-gradient-to-r from-indigo-400 to-indigo-600 text-gray py-3 rounded shadow-md font-medium hover:from-indigo-500 hover:to-indigo-700 transition duration-300">
                    Import
                </button>

                <a href="{{ route('employees.export') }}"
                    class="w-1/2 bg-gradient-to-r from-yellow-400 to-yellow-600 text-gray text-center py-3 rounded shadow-md font-medium hover:from-yellow-500 hover:to-yellow-700 transition duration-300">
                    Export
                </a>
            </div>
        </form>
    </div>

    <!-- Script for Drag & Drop Functionality -->
    <script>
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('file');
        const fileChosen = document.getElementById('file-chosen');

        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });

        // Highlight drop area on drag events
        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => dropArea.classList.add('bg-gray-100'), false);
        });
        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => dropArea.classList.remove('bg-gray-100'), false);
        });

        // Handle dropped files
        dropArea.addEventListener('drop', handleDrop, false);

        // File selection event
        fileInput.addEventListener('change', updateFileName);

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files; // Assign the dropped files to the file input
            updateFileName(); // Update the display with the selected file name
        }

        function updateFileName() {
            const fileName = fileInput.files[0]?.name || "No file chosen";
            fileChosen.textContent = fileName;
        }
    </script>
@endsection
