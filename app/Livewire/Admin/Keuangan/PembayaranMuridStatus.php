<?php

namespace App\Livewire\Admin\Keuangan;

use App\Models\Billing;
use App\Models\Expense;
use Livewire\Component;

class PembayaranMuridStatus extends Component
{
    public $billing, $diff = 0;

    public function mount($id)
    {
        $this->billing = Billing::with('theStudent', 'theClass', 'theStudentData', 'thePayment', 'theRefund')
            ->where('id', $id)
            ->firstOrFail();

        if ($this->billing->thePayment != null) {
            $this->diff = $this->billing->amount - $this->billing->thePayment->whereNotNull('confirm_date')->sum('amount');

            if (isset($this->billing->theRefund)) {
                // dd($this->billing->theRefund->sum('amount'));
                $this->diff += $this->billing->theRefund->sum('amount');
                // dd($this->diff);
            }

            if ($this->diff == 0 && $this->billing->thePayment != null) {
                session()->flash('success0', 'Tagihan lunas');
            } elseif ($this->diff > 0) {
                session()->flash('fail0', 'Tagihan belum lunas dengan jumlah kekurangan Rp.' . number_format($this->diff, 2, ',', '.'));
            } else {
                session()->flash('warning0', 'Tagihan lunas dengan jumlah kelebihan Rp.' . number_format($this->diff * -1, 2, ',', '.'));
            }
        }
    }

    public function makeRefund()
    {
        $refund = Expense::create([
            'due_date' => $this->billing->thePayment->max('pay_date')->addDays(10),
            'information' => 'Pengembalian dana billing #'.str_pad($this->billing->invoice_id, 5, '0', STR_PAD_LEFT),
            'amount' => $this->diff * -1,
            'billing_id' => $this->billing->id
        ]);
        session()->flash('success', 'Entri pengembalian dana berhasil dibuat');
        return $this->redirect(route('payment.student.status', ['id' => $this->billing->id]));

    }

    public function render()
    {
        return view('livewire.admin.keuangan.pembayaran-murid-status');
    }
}
