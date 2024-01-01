<?php

namespace App\Livewire\Student\Keuangan;

use App\Models\Course;
use App\Models\Billing;
use App\Models\Payment;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

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
        // dd($billings);

        $key = $this->searchActive;
        // $active = Billing::with('theClass', 'theStudent', 'theStudentData', 'thePayment')
        // ->whereHas('theStudentData', function($q) use ($key) {
        //     $q->search('name', $key)
        //     ->orderBy('name', 'asc');
        // })
        // // ->selectRaw('*, sum(amount) as total_price, max(due_date) as deadline')
        // ->whereNotIn('id', $billings)
        // ->where('student_id', $studentID)
        // ->orderBy('created_at')
        // // ->groupBy('student_id')
        // ->paginate(10);

        $confirm = Billing::with('theClass', 'theStudent.theGuardian', 'theClass', 'thePayment', 'theStudentData')
        ->whereHas('thePayment', function($q) {
            $q->whereNull('confirm_date');
        })
        ->where('student_id', $studentID)
        ->orderBy('created_at', 'desc')
        ->paginate(15);

        $active = Billing::with('theClass', 'theStudent.theGuardian', 'theClass', 'thePayment', 'theStudentData')
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
