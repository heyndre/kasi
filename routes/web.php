<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\FileAccessController;
use App\Livewire\Student\Active as StudentActive;
use App\Livewire\Student\Inactive as StudentInactive;
use App\Livewire\Student\Show as StudentShow;
use App\Livewire\Student\Register as StudentRegister;
use App\Livewire\Student\Edit as StudentEdit;
use App\Livewire\Student\Birthday as StudentBirthday;

use App\Livewire\Guardian\Index as GuardianList;
use App\Livewire\Guardian\Show as GuardianShow;
use App\Livewire\Guardian\Register as GuardianRegister;
use App\Livewire\Guardian\Edit as GuardianEdit;

use App\Livewire\Admin\KBM\Index as KBMList;
use App\Livewire\Admin\KBM\Show as KBMShow;
use App\Livewire\Admin\KBM\Edit as KBMEdit;


use App\Livewire\Tutor\Active as TutorActive;
use App\Livewire\Tutor\Inactive as TutorInactive;
use App\Livewire\Tutor\Show as TutorShow;
use App\Livewire\Tutor\Register as TutorRegister;
use App\Livewire\Tutor\Edit as TutorEdit;
// use App\Livewire\Tutor\Birthday as TutorBirthday;

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

    // File Access
    Route::get('/file/access/class/photo/{file}', [FileAccessController::class, 'accessClassPhoto'])->name('file.class.photo');

    // Student Menu
    Route::get('/murid/aktif', StudentActive::class)->name('student.active');
    Route::get('/murid/inaktif', StudentInactive::class)->name('student.inactive');
    Route::get('/murid/data/{nim}', StudentShow::class)->name('student.show');
    Route::get('/murid/edit/{nim}', StudentEdit::class)->name('student.edit');

    Route::get('/murid/registrasi', StudentRegister::class)->name('student.register');
    Route::get('/murid/kalender-ulang-tahun', StudentBirthday::class)->name('student.birthday');

    // Wali Murid / Guardian Menu
    Route::get('/wali-murid/list', GuardianList::class)->name('guardian.index');
    Route::get('/wali-murid/register', GuardianRegister::class)->name('guardian.register');
    Route::get('/wali-murid/show/{slug}', GuardianShow::class)->name('guardian.show');
    Route::get('/wali-murid/edit/{slug}', GuardianEdit::class)->name('guardian.edit');

    // KBM Menu
    Route::get('/kelas/list', KBMList::class)->name('kbm.index');
    Route::get('/kelas/detail/{id}', KBMShow::class)->name('kbm.show');
    Route::get('/kelas/edit/{id}', KBMEdit::class)->name('kbm.edit');

    // Tutor Menu
    Route::get('/tutor/aktif', TutorActive::class)->name('tutor.active');
    Route::get('/tutor/inaktif', TutorInactive::class)->name('tutor.inactive');
    Route::get('/tutor/data/{slug}', TutorShow::class)->name('tutor.show');
    Route::get('/tutor/edit/{slug}', TutorEdit::class)->name('tutor.edit');

    Route::get('/tutor/registrasi', TutorRegister::class)->name('tutor.register');
    // Route::get('/tutor/kalender-ulang-tahun', TutorBirthday::class)->name('tutor.birthday');
});

Route::group(['middleware' => ['web', WelcomesNewUsers::class,]], function () {
    Route::get('welcome/{user}', [WelcomeController::class, 'showWelcomeForm'])->name('welcome');
    Route::post('welcome/{user}', [WelcomeController::class, 'savePassword']);
});