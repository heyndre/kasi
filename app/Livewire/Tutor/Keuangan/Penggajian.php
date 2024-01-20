<?php

namespace App\Livewire\Tutor\Keuangan;

use App\Models\TutorPayment;
use Livewire\Component;

class Penggajian extends Component
{
    public function render()
    {
        $active = TutorPayment::with('theClass', 'theTutor', )
        ->whereNull('pay_date')
        ->where('tutor_id', auth()->user()->theTutor->id)
        ->selectRaw('*, SUM(amount) as total')
        ->groupBy('payment_number')
        ->paginate(10);

        $paid = TutorPayment::with('theClass', 'theTutor', )
        ->whereNotNull('pay_date')
        ->where('tutor_id', auth()->user()->theTutor->id)
        ->selectRaw('*, SUM(amount) as total')
        ->groupBy('payment_number')
        ->paginate(10);

        return view('livewire.tutor.keuangan.penggajian', [
            'active' => $active,
            'paid' => $paid,
        ]);
    }
}
