<?php

namespace App\Livewire\Admin\Keuangan;

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
        $billings = Payment::get()->pluck('billing_id');
        // dd($billings);

        $key = $this->searchActive;
        $active = Billing::with('theClass', 'theStudent', 'theStudentData', 'thePayment')
        ->whereHas('theStudentData', function($q) use ($key) {
            $q->search('name', $key)
            ->orderBy('name', 'asc');
        })
        ->whereDoesntHave('thePayment')
        // ->selectRaw('*, sum(amount) as total_price, max(due_date) as deadline')
        // ->whereNotIn('id', $billings)
        ->orderBy('created_at')
        // ->groupBy('student_id')
        ->paginate(10);

        $confirm = Billing::with('theClass', 'theStudent', 'theStudentData', 'thePayment')
        ->whereHas('theStudentData', function($q) use ($key) {
            $q->search('name', $key)
            ->orderBy('name', 'asc');
        })
        ->whereHas('thePayment', function($q) {
            $q->whereNull('confirm_date');
        })
        // ->selectRaw('*, sum(amount) as total_price, max(due_date) as deadline')
        // ->whereNotIn('id', $billings)
        ->orderBy('created_at')
        // ->groupBy('student_id')
        ->paginate(10);

        // dd($active);

        $paid = Billing::with('theClass', 'theStudent.theGuardian', 'theClass', 'thePayment', 'theStudentData')
        ->whereHas('thePayment', function($q) {
            $q->whereNotNull('confirm_date');
        })
        ->whereHas('theStudentData', function($q) use ($key) {
            $q->search('name', $key)
            ->orderBy('name', 'asc');
        })
        // ->selectRaw('*, sum(amount) as total_price, max(due_date) as deadline')
        // ->whereIn('id', $billings)
        ->orderBy('created_at', 'desc')
        // ->groupBy('student_id')
        ->paginate(15);

        // dd($paid);

        return view('livewire.admin.keuangan.billing-index', [
            'active' => $active,
            'paid' => $paid,
            'confirm' => $confirm,
        ]);
    }
}
