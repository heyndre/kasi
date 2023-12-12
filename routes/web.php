<?php

use App\Http\Controllers\Controller;
use App\Livewire\Student\Active as StudentActive;
use App\Livewire\Student\Inactive as StudentInactive;
use App\Livewire\Student\Show as StudentShow;
use App\Livewire\Student\Register as StudentRegister;
use App\Livewire\Student\Edit as StudentEdit;
use App\Livewire\Student\Birthday as StudentBirthday;

use Illuminate\Support\Facades\Route;
use Spatie\WelcomeNotification\WelcomesNewUsers;
use App\Http\Controllers\welcomeController;

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

Route::get('/test', [Controller::class, 'test']);

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
    Route::get('/murid/inaktif', StudentInactive::class)->name('student.inactive');
    Route::get('/murid/data/{nim}', StudentShow::class)->name('student.show');
    Route::get('/murid/edit/{nim}', StudentEdit::class)->name('student.edit');

    Route::get('/murid/registrasi', StudentRegister::class)->name('student.register');
    Route::get('/murid/kalender-ulang-tahun', StudentBirthday::class)->name('student.birthday');
});

Route::group(['middleware' => ['web', WelcomesNewUsers::class,]], function () {
    Route::get('welcome/{user}', [WelcomeController::class, 'showWelcomeForm'])->name('welcome');
    Route::post('welcome/{user}', [WelcomeController::class, 'savePassword']);
});