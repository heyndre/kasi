<?php

namespace App\Livewire\Admin\Keuangan;

use App\Models\Billing;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Tutor;
use App\Models\TutorPayment;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;


use Livewire\Component;

Class PembayaranMuridStatus extends Component
{
    public $course, $billing, $payment, $tutorSharing, $billingStatus, $invoiceNumber, $billingDate, $studentPayment, $studentPaymentID, $tutorPaymentID, $tutorPayment, $tutorPaymentDate, $tutorPaymentReceipt;

    public function mount($id)
    {
        $this->billing = Billing::with('theStudent', 'theClass', 'theStudentData', 'thePayment')
        ->where('id', $id)
        ->firstOrFail();

        
    }

    public function render()
    {
        return view('livewire.admin.keuangan.pembayaran-murid-status');
    }
}
