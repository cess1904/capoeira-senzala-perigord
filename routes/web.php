<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\PageController as PublicPageController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('pages', AdminPageController::class);
});

// Catch-all : toujours à la fin
Route::get('/{slug}', [PublicPageController::class, 'show'])
    ->name('pages.show');