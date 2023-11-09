<?php

use App\Livewire\Student\Active as StudentActive;
use App\Livewire\Student\Show as StudentShow;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
})->name('root');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    // Student Menu
    Route::get('/murid/aktif', StudentActive::class)->name('student.active');
    Route::get('/murid/data/{nim}', StudentShow::class)->name('student.show');
});
