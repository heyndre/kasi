<?php

use App\Http\Controllers\BillingController;
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
use App\Livewire\Admin\KBM\StatusIndex as KBMStatusIndex;

use App\Livewire\Admin\Keuangan\PembayaranMuridStatus as StatusPembayaranMurid;
use App\Livewire\Admin\Keuangan\KonfirmasiPayment as KonfirmasiStatusPembayaranMurid;
use App\Livewire\Admin\Keuangan\Refund\UploadReceipt as KonfirmasiRefundPembayaranMurid;
use App\Livewire\Admin\Keuangan\BillingIndex as BillingIndex;

use App\Livewire\Student\Keuangan\BillingIndex as StudentBillingIndex;
use App\Livewire\Student\Keuangan\UploadPayment as StudentUploadPayment;
use App\Livewire\Student\Kelas\Index as StudentClasses;

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

Route::view('default-billing', 'billing.default');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // File Access
    Route::get('/file/access/class/photo/{file?}', [FileAccessController::class, 'accessClassPhoto'])->name('file.class.photo');
    Route::get('/file/access/payment/student/{nim}/{filename?}', [FileAccessController::class, 'accessStudentReceipt'])->name('file.payment.student');
    Route::get('/file/access/payment/refund/{file}/{name?}', [FileAccessController::class, 'accessStudentRefund'])->name('file.payment.refund');

    Route::middleware('role:ADMIN,SUPERADMIN')->group(function () {

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
        Route::get('/kelas/status/billing', KBMStatusIndex::class)->name('kbm.billing.status');
        Route::get('/kelas/detail/{id}', KBMShow::class)->name('kbm.show');
        Route::get('/kelas/edit/{id}', KBMEdit::class)->name('kbm.edit');

        Route::get('kelas/billing/tambah/{id}', [BillingController::class, 'addBilling'])->name('billing.add');
        Route::get('kelas/billing/konfirmasi/{id}', [BillingController::class, 'confirmBilling'])->name('billing.confirm');
        Route::get('kelas/billing/ubah/{id}', [BillingController::class, 'updatePrice'])->name('billing.edit');
        Route::get('kelas/billing/unduh/{id}', [BillingController::class, 'generateInvoice'])->name('billing.download');


        // Finance Menu
        Route::get('keuangan/billing/status/{id}', StatusPembayaranMurid::class)->name('payment.student.status');
        Route::get('keuangan/billing/payment/confirm/{id}', KonfirmasiStatusPembayaranMurid::class)->name('payment.student.confirm');
        Route::get('keuangan/billing/payment/confirm/refund/{id}', KonfirmasiRefundPembayaranMurid::class)->name('payment.student.confirm.refund');
        // Route::get('keuangan/billing/konfirmasi/{id}', [BillingController::class, 'confirmBillPayment'])->name('payment.student.confirm');
        // Route::post('keuangan/billing/validasi/', [BillingController::class, 'submitBillPayment'])->name('payment.student.submit');
        Route::get('keuangan/billing/', BillingIndex::class)->name('payment.student.billing');



        Route::get('tes-pdf', [BillingController::class, 'testPDF'])->name('test.pdf');


        // Tutor Menu
        Route::get('/tutor/aktif', TutorActive::class)->name('tutor.active');
        Route::get('/tutor/inaktif', TutorInactive::class)->name('tutor.inactive');
        Route::get('/tutor/data/{slug}', TutorShow::class)->name('tutor.show');
        Route::get('/tutor/edit/{slug}', TutorEdit::class)->name('tutor.edit');

        Route::get('/tutor/registrasi', TutorRegister::class)->name('tutor.register');
        // Route::get('/tutor/kalender-ulang-tahun', TutorBirthday::class)->name('tutor.birthday');
    });

    // Student group
    Route::prefix('murid')->middleware('role:MURID')->group(function () {
        Route::get('keuangan/tagihan/', StudentBillingIndex::class)->name('student.billing.index');
        Route::get('keuangan/tagihan/unggah-pembayaran/{id}', StudentUploadPayment::class)->name('student.billing.upload');

        Route::get('keuangan/tagihan/unduh/{id}', [BillingController::class, 'generateInvoice'])->name('student.billing.download');

        Route::get('keuangan/status/{id}', StatusPembayaranMurid::class)->name('student.billing.status');

        Route::get('/profil/murid/data/{nim}', StudentShow::class)->name('student.profile.show');
        Route::get('/profil/wali-murid/show/{slug}', GuardianShow::class)->name('student.guardian.show');

        Route::get('/kelas/list', StudentClasses::class)->name('student.classes');
        Route::get('/kelas/status/billing', KBMStatusIndex::class)->name('student.classes.billing.status');
        Route::get('/kelas/detail/{id}', KBMShow::class)->name('student.classes.show');

    });
});

Route::group(['middleware' => ['web', WelcomesNewUsers::class,]], function () {
    Route::get('welcome/{user}', [WelcomeController::class, 'showWelcomeForm'])->name('welcome');
    Route::post('welcome/{user}', [WelcomeController::class, 'savePassword']);
});
