<?php

namespace App\Livewire\Guardian\Keuangan;

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
        $children = auth()->user()->theGuardian->theChildren->pluck('id');
        // dd($children);
        $billings = Payment::with('theBill')
        ->whereHas('theBill', function ($q) use ($children) {
            $q->whereIn('student_id', $children);
        })
        ->get()
        ->pluck('billing_id');

        $key = $this->searchActive;

        $confirm = Billing::with('theClass', 'theStudent.theGuardian', 'theClass', 'thePayment', 'theStudentData')
        ->whereHas('thePayment', function($q) {
            $q->whereNull('confirm_date');
        })
        // ->where('amount', '>=',$this->thePayment->sum('amount'))
        ->whereIn('student_id', $children)
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
        ->whereIn('student_id', $children)
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
        ->whereIn('student_id', $children)
        ->orderBy('created_at', 'desc')
        ->paginate(15);

        // dd($paid);

        return view('livewire.guardian.keuangan.billing-index', [
            'active' => $active,
            'paid' => $paid,
            'confirm' => $confirm,
        ]);
    }
}
