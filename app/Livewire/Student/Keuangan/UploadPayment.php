<?php

namespace App\Livewire\Student\Keuangan;

use App\Jobs\SendStudentReceiptConfirm;
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
use Spatie\Image\Enums\Fit;
use Illuminate\Support\Str;
use Spatie\Browsershot\Browsershot;

class UploadPayment extends Component
{
    use WithFileUploads;

    public $receipt, $payMethod = 'waiting', $packageData, $theBillData;

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
        // dd($this->payMethod);
        $billing = $this->theBillData;

        if ($this->receipt != null) {
            Image::load($this->receipt->getRealPath())->fit(Fit::Max, 1080, 1920)->optimize()->save();
            $name = str_pad($billing->invoice_id, 5, '0', STR_PAD_LEFT) . '-' . now()->format('Ymd His') . '.' . pathinfo($this->receipt->getFilename(), PATHINFO_EXTENSION);
            $filename = $this->receipt->storeAs($billing->theStudent->nim, $name, 'student-payment');
        } else {
            if ($this->payMethod == 'bank_transfer' || $this->payMethod == 'other') {
                session()->flash('receipt', 'Pilih file untuk diunggah');
                return;
            }
        }

        if ($this->payMethod == 'bank_transfer' || $this->payMethod == 'other') {
            $payment = Payment::create([
                'billing_id' => $billing->id,
                'pay_date' => now(),
                // 'amount' => $billing->amount,
                'pay_method' => $this->payMethod,
                'payment_file' => $filename,
            ]);

            session()->flash('success', 'Unggah bukti pembayaran berhasil - Bukti Pembayaran #' . str_pad($payment->id, 5, '0', STR_PAD_LEFT));
        } else {
            // dd('package');
            $package = Package::where('student_id', $billing->student_id)
                ->firstOrFail();

            if ($package->remaining >= $billing->length) {
                $payment = Payment::create([
                    'billing_id' => $billing->id,
                    'pay_date' => now(),
                    'confirm_date' => now(),
                    'amount' => $billing->length / 60 * $package->price_per_unit,
                    'pay_method' => $this->payMethod,
                    'package_id' => $package->id,
                    'confirmed_by' => 1,
                ]);
                $package->update([
                    'remaining' => $package->remaining - $billing->length,
                ]);
                session()->flash('success', 'Pembayaran menggunakan paket berhasil dengan bukti pembayaran #' . str_pad($payment->id, 5, '0', STR_PAD_LEFT));
            } else {
                $payment = Payment::create([
                    'billing_id' => $billing->id,
                    'pay_date' => now(),
                    'confirm_date' => now(),
                    'amount' => ($billing->length - $package->remaining) / 60 * $package->price_per_unit,
                    'pay_method' => $this->payMethod,
                    'package_id' => $package->id,
                    'confirmed_by' => 1,
                ]);
                $package->update([
                    'remaining' => 0,
                ]);

                // $newbilling = Billing::create([
                //     'bill_date' => now()->addMonth()->startOfMonth(),
                //     'due_date' => now()->addMonth()->startOfMonth()->addDays(10),
                //     'amount' => ($billing->length - $package->remanining) / 60 * $package->price_per_unit,
                //     'invoice_id' => Billing::max('invoice_id') + 1,
                //     'student_id' => $billing->student_id,
                //     'length' => $billing->length - $package->remanining,
                // ]);

                session()->flash('warning', 'Pembayaran menggunakan paket berhasil dengan kekurangan, bukti pembayaran #' . str_pad($payment->id, 5, '0', STR_PAD_LEFT));
            }

            $filename = $billing->theStudent->nim . '/SIPAKA-' . str_pad($payment->id, 5, '0', STR_PAD_LEFT) . '.png';
            // dd($billing->theClass[0]);
            if (PHP_OS == 'Linux') {
                $image = Browsershot::html(view('billing.package-payment', ['billing' => $billing, 'package' => $package])->render())
                    ->waitUntilNetworkIdle()
                    ->newHeadless()
                    ->setRemoteInstance('127.0.0.1', 9222)
                    ->setCustomTempPath(storage_path('/tmp'))
                    ->setNodeBinary('/www/server/nvm/versions/node/v20.11.0/bin/node')
                    ->setNpmBinary('/www/server/nvm/versions/node/v20.11.0/bin/npm')
                    ->userDataDir('/var/fileexchange')
                    ->usePipe()
                    ->mobile()
                    ->fullPage()
                    ->deviceScaleFactor(2)
                    ->disableJavascript()
                    ->device('iPhone 13 Mini landscape')
                    // ->base64Screenshot();
                    ->save(storage_path("app/billing/student-payment-receipt/" . $filename));
                ob_end_clean();
            } else {
                $image = Browsershot::html(view('billing.package-payment', ['billing' => $billing, 'package' => $package])->render())
                    ->waitUntilNetworkIdle()
                    ->newHeadless()
                    ->setRemoteInstance('127.0.0.1', 9222)
                    ->usePipe()
                    ->mobile()
                    ->fullPage()
                    ->deviceScaleFactor(2)
                    ->disableJavascript()
                    ->device('iPhone 13 Mini landscape')
                    // ->base64Screenshot();
                    ->save(storage_path("app/billing/student-payment-receipt/" . $filename));
                ob_end_clean();
            }

            $payment->update([
                'payment_file' => $filename
            ]);
        }

        $recipients = User::management()->get();
        foreach ($recipients as $to) {
            $data = [
                'email' => $to->email,
                'billingID' => $billing->id,
                'paymentID' => $payment->id,
                'studentPayTime' => $payment->pay_date->format('d/m/Y H:i:s T'),
                // 'guardianName' => $billing->theStudent->theGuardian->userData->name,
                'studentName' => $billing->theStudent->userData->name,
                'studentNIM' => $billing->theStudent->nim,

            ];
            SendStudentReceiptConfirm::dispatch($data);
        }

        if (auth()->user()->isStudent()) {
            return $this->redirect(route('student.billing.status', ['id' => $billing->id]));
        } elseif (auth()->user()->isGuardian()) {
            return $this->redirect(route('guardian.billing.status', ['id' => $billing->id]));
        } elseif (auth()->user()->isManagement()) {
            return $this->redirect(route('payment.student.status', ['id' => $billing->id]));
        }
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
