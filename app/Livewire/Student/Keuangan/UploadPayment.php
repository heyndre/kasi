<?php

namespace App\Livewire\Student\Keuangan;

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

class UploadPayment extends Component
{
    use WithFileUploads;

    public $receipt, $payMethod = 'bank_transfer', $packageData, $theBillData;

    public function mount($id)
    {
        $this->theBillData = Billing::with('theClass', 'theStudent', 'theStudentData', 'thePayment')
            ->where('id', $id)
            ->firstOrFail();

        $this->packageData = Package::where('student_id', $this->theBillData->student_id)
            ->first();
    }

    public function uploadPayment()
    {
        // dd(pathinfo($this->receipt->getFilename(), PATHINFO_EXTENSION));
        $billing = $this->theBillData;

        if ($this->receipt != null) {
            Image::load($this->receipt->getRealPath())->fit(Manipulations::FIT_FILL_MAX, 1080, 1920)->optimize()->save();
            $filename = $this->receipt->storeAs($billing->theStudent->nim, $billing->inovice_id . '-' . now()->format('Ymd His') . '.' . pathinfo($this->receipt->getFilename(), PATHINFO_EXTENSION), 'student-payment');
        } else {
            return;
        }

        if ($this->payMethod == 'bank_transfer' || $this->payMethod == 'other') {
            $payment = Payment::create([
                'billing_id' => $billing->id,
                'pay_date' => now(),
                'amount' => $billing->amount,
                'pay_method' => $this->payMethod,
                'payment_file' => $filename,
            ]);

            session()->flash('success', 'Unggah bukti pembayaran berhasil - Bukti Pembayaran #' . str_pad($payment->id, 5, '0', STR_PAD_LEFT));
        } else {
            $package = Package::where('student_id', $billing->student_id)
                ->firstOrFail();

            if ($package->remaining >= $billing->length) {
                $payment = Payment::create([
                    'billing_id' => $billing->id,
                    'pay_date' => now(),
                    'amount' => $billing->length / 60 * $package->price_per_unit,
                    'pay_method' => $this->payMethod,
                    'package_id' => $package->id,
                ]);
            } else {
                $payment = Payment::create([
                    'billing_id' => $billing->id,
                    'pay_date' => now(),
                    'amount' => ($billing->length - $package->remaining) / 60 * $package->price_per_unit,
                    'pay_method' => $this->payMethod,
                    'package_id' => $package->id,
                ]);
            }
        }

        return $this->redirect(route('payment.student.status', ['id' => $billing->id]));
    }

    public function updatedReceipt()
    {
        $this->validate(['receipt' => ['max:5120']], [
            // 'avatar.image' => 'Silakan masukkan file gambar',
            'receipt.max' => 'Ukuran file maksimal 5 MB',
        ]);
    }

    public function render()
    {
        return view('livewire.student.keuangan.upload-payment');
    }
}
