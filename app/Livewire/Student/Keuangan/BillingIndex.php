<?php

namespace App\Livewire\Student\Keuangan;

use App\Models\Course;
use App\Models\Billing;
use App\Models\Payment;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BillingIndex extends Component
{

    use WithPagination;

    public $searchActive, $searchPaid;

    public function render()
    {
        $studentID = auth()->user()->theStudent->id;
        $billings = Payment::with('theBill')
        ->whereHas('theBill', function ($q) use ($studentID) {
            $q->where('student_id', $studentID);
        })
        ->get()
        ->pluck('billing_id');

        $key = $this->searchActive;

        $confirm = Billing::with('theClass', 'theStudent.theGuardian', 'theClass', 'thePayment', 'theStudentData')
        ->whereHas('thePayment', function($q) {
            $q->whereNull('confirm_date');
        })
        // ->where('amount', '>=',$this->thePayment->sum('amount'))
        ->where('student_id', $studentID)
        ->orderBy('created_at', 'desc')
        ->paginate(15);

        $active = Billing::with('theClass', 'theStudent.theGuardian', 'theClass', 'thePayment', 'theStudentData')
        // ->withSum('thePayment', 'amount')
        // ->where('amount', '>', 'the_payment_sum_amount')
        // ->whereHas('thePayment', function ($q) {
        //     $q->selectRaw('SUM(payments.amount) < billings.amount')
        //     ->whereNotNull('confirm_date');
        //     // ->sum('amount');
        // })
        ->whereDoesntHave('thePayment')
        ->where('student_id', $studentID)
        ->orderBy('created_at', 'desc')
        ->paginate(15);

        // dd($active);

        $paid = Billing::with('theClass', 'theStudent.theGuardian', 'theClass', 'thePayment', 'theStudentData')
        ->whereHas('thePayment', function($q) {
            $q->whereNotNull('confirm_date');
        })
        ->whereHas('theStudentData', function($q) use ($key) {
            $q->search('name', $key)
            ->orderBy('name', 'asc');
        })
        ->where('student_id', $studentID)
        ->orderBy('created_at', 'desc')
        ->paginate(15);

        // dd($paid);

        return view('livewire.student.keuangan.billing-index', [
            'active' => $active,
            'paid' => $paid,
            'confirm' => $confirm,
        ]);
    }
}
