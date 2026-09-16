<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\PageController as PublicPageController;
use App\Http\Controllers\CourseController;

Route::get('/', function () {
    return view('welcome');
});

// toutes les routes normales/admin 
Route::prefix('admin')->name('admin.')->group(function () {

    Route::resource('pages', AdminPageController::class);

    Route::get('courses', [CourseController::class, 'index'])
        ->name('courses.index');

    Route::get('courses/create', [CourseController::class, 'create'])
        ->name('courses.create');

  Route::post('courses', [CourseController::class, 'store'])
        ->name('courses.store');

        Route::get('courses/{course}/edit', [CourseController::class, 'edit'])
    ->name('courses.edit');

    Route::put('courses/{course}', [CourseController::class, 'update'])
    ->name('courses.update');

    Route::delete('courses/{course}', [CourseController::class, 'destroy'])
    ->name('courses.destroy');

    Route::get('courses/{course}/duplicate', [CourseController::class, 'duplicate'])
    ->name('courses.duplicate');    

});






// Catch-all
Route::get('/{slug}', [PublicPageController::class, 'show'])
    ->name('pages.show');