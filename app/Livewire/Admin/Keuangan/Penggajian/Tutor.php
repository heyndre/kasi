<?php

namespace App\Livewire\Admin\Keuangan\Penggajian;

use App\Models\TutorPayment;
use Livewire\Component;

class Tutor extends Component
{
    public function render()
    {
        $active = TutorPayment::with('theClass', 'theTutor', )
        ->whereNull('pay_date')
        ->selectRaw('*, SUM(amount) as total')
        ->groupBy('payment_number')
        ->paginate(10);

        $paid = TutorPayment::with('theClass', 'theTutor', )
        ->whereNotNull('pay_date')
        ->selectRaw('*, SUM(amount) as total')
        ->groupBy('payment_number')
        ->orderBy('payment_number', 'DESC')
        ->paginate(10);

        return view('livewire.admin.keuangan.penggajian.tutor', [
            'active' => $active,
            'paid' => $paid,
        ]);
    }
}
