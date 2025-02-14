<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SubjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->prefix('admin')->group(function () {
    // Courses
    Route::prefix('course')->name('course.')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::post('/store', [CourseController::class, 'store'])->name('store');
        Route::get('/edit/{slug}', [CourseController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CourseController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [CourseController::class, 'destroy'])->name('destroy');
    });

    //section
    Route::prefix('section')->name('section.')->group(function () {
        Route::get('/', [SectionController::class, 'index'])->name('index');
        Route::post('/store', [SectionController::class, 'store'])->name('store');
        Route::get('/edit/{slug}', [SectionController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [SectionController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [SectionController::class, 'destroy'])->name('destroy');
    });

    //subject
    Route::prefix('subject')->name('subject.')->group(function () {
        Route::get('/', [SubjectController::class, 'index'])->name('index');
        Route::post('/store', [SubjectController::class, 'store'])->name('store');
        Route::get('/edit/{slug}', [SubjectController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [SubjectController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [SubjectController::class, 'destroy'])->name('destroy');

        //ajax
        Route::get('/get-sections', [SubjectController::class, 'getSections'])->name('get_sections');
    });
});







require __DIR__.'/auth.php';
