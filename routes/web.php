<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AbsenceController;

// Rute untuk halaman utama, hanya bisa diakses oleh guest
Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

// Rute untuk halaman "About", hanya bisa diakses oleh guest
Route::get('/about', function () {
    return view('about');
})->middleware('guest')->name('about');

Auth::routes();

// Group routes for EmployeeController
Route::prefix('employees')->name('employees.')->middleware('auth')->group(function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('index');
    Route::get('/create', [EmployeeController::class, 'create'])->name('create');
    Route::post('/store', [EmployeeController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [EmployeeController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [EmployeeController::class, 'update'])->name('update');
    Route::delete('/{id}', [EmployeeController::class, 'destroy'])->name('destroy');
    Route::get('/salary/{id}', [EmployeeController::class, 'show'])->name('salary');
    Route::get('/show/{id}', [EmployeeController::class, 'showAll'])->name('show');
    Route::post('/{id}/mark-all-as-paid', [EmployeeController::class, 'markAllAsPaid'])->name('markAllAsPaid');
    Route::post('/{id}/mark-all-as-payment', [EmployeeController::class, 'markAllAsPayment'])->name('markAllAsPayment');
    Route::get('/importexport', [EmployeeController::class, 'importExport'])->name('importexport');
    Route::get('/export', [EmployeeController::class, 'export'])->name('export');
    Route::post('/import', [EmployeeController::class, 'import'])->name('import');
    Route::get('/search', [EmployeeController::class, 'search'])->name('search');
    Route::delete('/', [EmployeeController::class, 'deleteAll'])->name('deleteAll');
});

// Group routes for AbsenceController
Route::prefix('user')->name('user.')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('auth.user');
    })->name('index');
});

Route::prefix('absences')->name('absences.')->middleware('auth')->group(function () {
    Route::get('/', [AbsenceController::class, 'index'])->name('index');
    Route::get('/create', [AbsenceController::class, 'create'])->name('create');
    Route::post('/store', [AbsenceController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [AbsenceController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [AbsenceController::class, 'update'])->name('update');
    Route::delete('/{id}', [AbsenceController::class, 'destroy'])->name('destroy');
    Route::get('/show/{id}', [AbsenceController::class, 'show'])->name('show');
    Route::get('/show-employees', [AbsenceController::class, 'showEmployeesForDate'])->name('showEmployees');
    Route::get('/importexport', [AbsenceController::class, 'importExport'])->name('importexport');
    Route::post('/import', [AbsenceController::class, 'import'])->name('import');
    Route::get('/export', [AbsenceController::class, 'export'])->name('export');
    Route::delete('/', [AbsenceController::class, 'deleteAll'])->name('deleteAll');
});

Route::get('/home', [AbsenceController::class, 'getAbsenceSummary'])->middleware('auth')->name('absences.summary');
