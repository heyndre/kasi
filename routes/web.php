<?php

use App\Http\Controllers\BillingController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FileAccessController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MeetingController;
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
use App\Livewire\Admin\KBM\Reschedule as KBMReschedule;
use App\Livewire\Admin\KBM\EditStatus as KBMStatusEdit;
use App\Livewire\Admin\KBM\Create as KBMAdd;
use App\Livewire\Admin\KBM\StatusIndex as KBMStatusIndex;

use App\Livewire\Admin\Keuangan\PembayaranMuridStatus as StatusPembayaranMurid;
use App\Livewire\Admin\Keuangan\KonfirmasiPayment as KonfirmasiStatusPembayaranMurid;
use App\Livewire\Admin\Keuangan\Refund\UploadReceipt as KonfirmasiRefundPembayaranMurid;
use App\Livewire\Admin\Keuangan\BillingIndex as BillingIndex;

use App\Livewire\Admin\Keuangan\Penggajian\Tutor as HonorTutorIndex;
use App\Livewire\Admin\Keuangan\Penggajian\TutorReceipt as HonorTutorReceipt;

use App\Livewire\Student\Keuangan\BillingIndex as StudentBillingIndex;
use App\Livewire\Student\Keuangan\UploadPayment as StudentUploadPayment;
use App\Livewire\Student\Kelas\Index as StudentClasses;

use App\Livewire\Guardian\Keuangan\BillingIndex as GuardianBillingIndex;
use App\Livewire\Guardian\Kelas\Index as GuardianClasses;

use App\Livewire\Tutor\Kelas\Index as TutorClasses;
use App\Livewire\Tutor\Kelas\Edit as TutorClassEdit;

use App\Livewire\Tutor\Active as TutorActive;
use App\Livewire\Tutor\Inactive as TutorInactive;
use App\Livewire\Tutor\Show as TutorShow;
use App\Livewire\Tutor\Register as TutorRegister;
use App\Livewire\Tutor\Edit as TutorEdit;
use App\Livewire\Tutor\Murid\Aktif as TutorStudentActive;
use App\Livewire\Tutor\Murid\Inaktif as TutorStudentInactive;
use App\Livewire\Tutor\Keuangan\Penggajian as TutorSeeFee;

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
Route::get('tes-mail', function () {
    $data['text'] = "Queued mail";
    $data['email'] = 'student@kasi.web.id';
    dispatch(new App\Jobs\SendRegisterStudent($data, 'student@kasi.web.id'));

    dd('Mail sent successfully.');
});

// Route::get('tes-fee', [MeetingController::class, 'tesFee']);


Route::view('default-billing', 'billing.default');
Route::view('mail-student-attendance', 'mail.student-attendance');

Route::get('language/{lang}', [LanguageController::class, 'setLanguage'])->name('language.switch');

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
    Route::get('/file/access/payment/tutor/{slug}/{filename?}', [FileAccessController::class, 'accessTutorReceipt'])->name('file.payment.tutor');

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
        Route::get('/kelas/jadwalkan', KBMAdd::class)->name('kbm.add');
        Route::get('/kelas/status/billing', KBMStatusIndex::class)->name('kbm.billing.status');
        Route::get('/kelas/detail/{id}', KBMShow::class)->name('kbm.show');
        Route::get('/kelas/edit/{id}', KBMEdit::class)->name('kbm.edit');
        Route::get('/kelas/edit/ubah-jadwal/{id}', KBMReschedule::class)->name('kbm.edit.reschedule');
        Route::get('/kelas/edit/ubah-status/{id}', KBMStatusEdit::class)->name('kbm.edit.status');

        Route::get('kelas/billing/tambah/{id}', [BillingController::class, 'addBilling'])->name('billing.add');
        Route::get('kelas/billing/konfirmasi/{id}', [BillingController::class, 'confirmBilling'])->name('billing.confirm');
        Route::get('kelas/billing/ubah/{id}', [BillingController::class, 'updatePrice'])->name('billing.edit');
        Route::get('kelas/billing/unduh/{id}', [BillingController::class, 'generateInvoice'])->name('billing.download');
        Route::get('kelas/billing/unduh-png/{id}', [BillingController::class, 'generateInvoiceImage'])->name('billing.download.image');


        // Finance Menu
        Route::get('keuangan/billing/status/{id}', StatusPembayaranMurid::class)->name('payment.student.status');
        Route::get('keuangan/billing/payment/confirm/{id}', KonfirmasiStatusPembayaranMurid::class)->name('payment.student.confirm');
        Route::get('keuangan/billing/payment/confirm/refund/{id}', KonfirmasiRefundPembayaranMurid::class)->name('payment.student.confirm.refund');
        // Route::get('keuangan/billing/konfirmasi/{id}', [BillingController::class, 'confirmBillPayment'])->name('payment.student.confirm');
        // Route::post('keuangan/billing/validasi/', [BillingController::class, 'submitBillPayment'])->name('payment.student.submit');
        Route::get('keuangan/billing/', BillingIndex::class)->name('payment.student.billing');
        Route::get('keuangan/tagihan/unggah-pembayaran/{id}', StudentUploadPayment::class)->name('billing.upload');

        Route::get('keuangan/penggajian/tutor', HonorTutorIndex::class)->name('finance.tutor.fee');
        Route::get('keuangan/penggajian/tutor/receipt/{id}', HonorTutorReceipt::class)->name('finance.tutor.fee.receipt');
        Route::get('keuangan/penggajian/tutor/status/{id}', HonorTutorIndex::class)->name('finance.tutor.fee.status');

        Route::get('tes-pdf', [BillingController::class, 'testPDF'])->name('test.pdf');
        
        // Calculate Fee
        Route::get('/keuangan/calculate-fee', [MeetingController::class, 'tesFee'])->name('calculate.tutor.fee');


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
        Route::get('keuangan/tagihan/unduh-png/{id}', [BillingController::class, 'generateInvoiceImage'])->name('student.billing.download.image');

        Route::get('keuangan/status/{id}', StatusPembayaranMurid::class)->name('student.billing.status');

        Route::get('/profil/murid/data/{nim}', StudentShow::class)->name('student.profile.show');
        Route::get('/profil/wali-murid/show/{slug}', GuardianShow::class)->name('student.guardian.show');

        Route::get('/kelas/list', StudentClasses::class)->name('student.classes');
        Route::get('/kelas/status/billing', KBMStatusIndex::class)->name('student.classes.billing.status');
        Route::get('/kelas/detail/{id}', KBMShow::class)->name('student.classes.show');
        Route::get('/kelas/konfirmasi-kehadiran/{id}', [MeetingController::class, 'studentAttendance'])->name('student.classes.attendance');
    });

    // Guardian group
    Route::prefix('wali-murid')->middleware('role:WALI MURID')->group(function () {
        Route::get('keuangan/tagihan/', GuardianBillingIndex::class)->name('guardian.billing.index');
        Route::get('keuangan/tagihan/unggah-pembayaran/{id}', StudentUploadPayment::class)->name('guardian.billing.upload');

        Route::get('keuangan/tagihan/unduh/{id}', [BillingController::class, 'generateInvoice'])->name('guardian.billing.download');
        Route::get('keuangan/tagihan/unduh-png/{id}', [BillingController::class, 'generateInvoiceImage'])->name('guardian.billing.download.image');

        Route::get('keuangan/status/{id}', StatusPembayaranMurid::class)->name('guardian.billing.status');

        Route::get('/profil/murid/data/{nim}', StudentShow::class)->name('guardian.student.show');
        Route::get('/profil/wali-murid/show/{slug}', GuardianShow::class)->name('guardian.show.profile');

        Route::get('/kelas/list', GuardianClasses::class)->name('guardian.classes');
        Route::get('/kelas/status/billing', KBMStatusIndex::class)->name('guardian.classes.billing.status');
        Route::get('/kelas/detail/{id}', KBMShow::class)->name('guardian.classes.show');
        // Route::get('/kelas/konfirmasi-kehadiran/{id}', [MeetingController::class, 'studentAttendance'])->name('student.classes.attendance');
    });

    // Tutor group
    Route::prefix('tutor')->middleware('role:TUTOR')->group(function () {
        Route::get('keuangan/tagihan/', StudentBillingIndex::class)->name('tutor.billing.index');
        Route::get('keuangan/tagihan/unggah-pembayaran/{id}', StudentUploadPayment::class)->name('tutor.billing.upload');

        Route::get('keuangan/tagihan/unduh/{id}', [BillingController::class, 'generateInvoice'])->name('tutor.billing.download');

        Route::get('keuangan/status/{id}', StatusPembayaranMurid::class)->name('tutor.billing.status');

        Route::get('/profil/murid/data/{nim}', StudentShow::class)->name('student.profile.show');
        Route::get('/profil/wali-murid/show/{slug}', GuardianShow::class)->name('tutor.guardian.show');

        Route::get('/kelas/list', TutorClasses::class)->name('tutor.classes');
        Route::get('/kelas/status/billing', KBMStatusIndex::class)->name('tutor.classes.billing.status');
        Route::get('/kelas/detail/{id}', KBMShow::class)->name('tutor.classes.show');
        Route::get('/kelas/edit/{id}', TutorClassEdit::class)->name('tutor.classes.edit');
        Route::get('/kelas/konfirmasi-kehadiran/{id}', [MeetingController::class, 'tutorAttendance'])->name('tutor.classes.attendance');

        Route::get('/murid/list/aktif', TutorStudentActive::class)->name('tutor.students.active');
        Route::get('/murid/list/inaktif', TutorStudentInactive::class)->name('tutor.students.inactive');
        Route::get('/data/murid/{nim}', StudentShow::class)->name('tutor.student.show');
        Route::get('keuangan/penggajian', TutorSeeFee::class)->name('tutor.my-fee');
    });
});

Route::group(['middleware' => ['web', WelcomesNewUsers::class,]], function () {
    Route::get('welcome/{user}', [WelcomeController::class, 'showWelcomeForm'])->name('welcome');
    Route::post('welcome/{user}', [WelcomeController::class, 'savePassword']);
});
