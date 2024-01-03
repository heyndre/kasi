<?php

namespace App\Livewire\Admin\Keuangan;

use App\Models\Billing;
use App\Models\Student;
use App\Models\User;
use App\Models\Guardian;
use App\Models\Package;
use App\Models\Payment;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Image\Image as Image;
use Spatie\Image\Manipulations;
use Illuminate\Support\Str;

class KonfirmasiPayment extends Component
{
    use WithFileUploads;

    public $receipt, $payment, $validStatus, $amount;

    public function mount($id)
    {
        $this->payment = Payment::with('theBill')
            ->where('id', $id)
            ->firstOrFail();

        if ($this->payment->confirm_date !== null) {
            $this->validStatus = 'valid';
        }
    }

    public function validatePayment()
    {
        // dd($this);

        if ($this->validStatus == 'valid') {
            $this->payment->update([
                'confirm_date' => now(),
                'amount' => $this->amount,
                'confirmed_by' => auth()->user()->id,
            ]);
            session()->flash('success', 'Validasi bukti pembayaran berhasil - Bukti Pembayaran #' . str_pad($this->payment->id, 5, '0', STR_PAD_LEFT));
        } else {
            $this->payment->update([
                'confirm_date' => null,
                'amount' => $this->amount,
                'confirmed_by' => auth()->user()->id,
            ]);
            session()->flash('warning', 'Bukti Pembayaran #' . str_pad($this->payment->id, 5, '0', STR_PAD_LEFT) . ' tidak valid');
        }

        return $this->redirect(route('payment.student.status', ['id' => $this->payment->theBill->id]));
    }

    public function render()
    {
        return view('livewire.admin.keuangan.konfirmasi-payment');
    }
}
