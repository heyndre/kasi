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

class PembayaranMuridStatus extends Component
{
    public $billing, $diff = 0;

    public function mount($id)
    {
        $this->billing = Billing::with('theStudent', 'theClass', 'theStudentData', 'thePayment')
            ->where('id', $id)
            ->firstOrFail();

        if ($this->billing->thePayment != null) {
            $this->diff = $this->billing->amount - $this->billing->thePayment->whereNotNull('confirm_date')->sum('amount');

            if ($this->diff == 0 && $this->billing->thePayment != null) {
                session()->flash('success0', 'Tagihan lunas');
            } elseif ($this->diff > 0) {
                session()->flash('fail0', 'Tagihan belum lunas dengan jumlah kekurangan Rp.' . number_format($this->diff, 2, ',', '.'));
            } else {
                session()->flash('warning0', 'Tagihan lunas dengan jumlah kelebihan Rp.' . number_format($this->diff * -1, 2, ',', '.'));
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.keuangan.pembayaran-murid-status');
    }
}
