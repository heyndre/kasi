<?php

namespace App\Livewire\Admin\KBM;

use App\Models\Billing;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Tutor;
use App\Models\TutorPayment;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;


use Livewire\Component;

class Show extends Component
{
    public $course, $billing, $payment, $tutorSharing, $link, $billingStatus, $invoiceNumber, $billingDate, $studentPayment, $studentPaymentID, $tutorPaymentID, $tutorPayment, $tutorPaymentDate, $tutorPaymentReceipt;

    public function mount($id)
    {
        $this->course = Course::with('theTutor', 'theStudent', 'theCourse', 'theBilling',)
            ->where('id', $id)
            ->firstOrFail();

        $this->link = Setting::where('key', 'default_link')->first()->value;
        // dd($this->link);
        $this->billing = $this->course->theBilling;
        if ($this->course->theBilling) {
            $this->billingDate = $this->billing->bill_date->format('d M Y H:i T');
            $this->billingStatus = 'Ditagih';
            $this->invoiceNumber = str_pad($this->billing->invoice_id, 5, '0', STR_PAD_LEFT);

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

    public function cancelClass()
    {
        $this->course->update([
            'status' => 'CANCELLED'
        ]);
        session()->flash('warning', 'Status kelas dibatalkan.');
        return $this->redirect(route('kbm.show', ['id' => $this->course->id]), navigate: false);
    }

    public function finishClass()
    {
        $this->course->update([
            'status' => 'CONDUCTED'
        ]);
        session()->flash('success', 'Status kelas diselesaikan.');
        return $this->redirect(route('kbm.show', ['id' => $this->course->id]), navigate: false);
    }

    public function burnClass()
    {
        $this->course->update([
            'status' => 'BURNED'
        ]);
        session()->flash('success', 'Status kelas diselesaikan tanpa kehadiran murid.');
        return $this->redirect(route('kbm.show', ['id' => $this->course->id]), navigate: false);
    }

    public function render()
    {
        return view('livewire.admin.kbm.show');
    }
}
