<?php

namespace App\Livewire\Admin\KBM;

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

class Show extends Component
{
    public $course, $billing, $payment, $tutorSharing, $billingStatus, $invoiceNumber, $billingDate, $studentPayment, $studentPaymentID, $tutorPaymentID, $tutorPayment, $tutorPaymentDate, $tutorPaymentReceipt;

    public function mount($id)
    {
        $this->course = Course::with('theTutor', 'theStudent', 'theCourse')
            ->where('id', $id)
            ->firstOrFail();
        $this->billing = Billing::where('class_id', $id)->first();
        if ($this->billing) {
            $this->billingDate = $this->billing->bill_date->format('d M Y H:i T');
            $this->billingStatus = 'Ditagih';
            $this->invoiceNumber = $this->billing->invoice_id;

            $this->payment = Payment::where('billing_id', $this->billing->id)->first();
            $this->tutorSharing = TutorPayment::where('billing_id', $this->billing->id)->first();

        } else {
            $this->billingStatus = 'Belum ditagih';
            $this->billingDate = 'N/A';
            $this->invoiceNumber = 'N/A';
        }

        if ($this->payment) {
            $this->studentPayment = 'Lunas';
            $this->studentPaymentID = $this->payment->id;
        } else {
            $this->studentPayment = 'Belum Lunas';
            $this->studentPaymentID = 'N/A';
        }

        if ($this->tutorSharing) {
            $this->tutorPayment = 'Terbayar';
            $this->tutorPaymentDate = $this->tutorSharing->pay_date->format('d M Y H:i T');
            $this->tutorPaymentReceipt = $this->tutorSharing->id;
        } else {
            $this->tutorPayment = 'Belum terbayar';
            $this->tutorPaymentDate = 'N/A';
            $this->tutorPaymentReceipt = 'N/A';
        }
    }

    public function render()
    {
        return view('livewire.admin.kbm.show');
    }
}
