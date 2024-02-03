<?php

namespace App\Livewire\Admin\Keuangan\Penggajian;

use App\Jobs\SendTutorFeePayment;
use App\Models\Billing;
use App\Models\Expense;
use App\Models\Student;
use App\Models\User;
use App\Models\Guardian;
use App\Models\Package;
use App\Models\Payment;
use App\Models\TutorPayment;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Image\Image as Image;
use Spatie\Image\Manipulations;
use Illuminate\Support\Str;
use Spatie\Image\Enums\Fit;

class TutorReceipt extends Component
{
    use WithFileUploads;

    public $receipt, $data, $payMethod = 'bank_transfer', $addInfo, $total;

    public function mount($id)
    {
        $this->data = TutorPayment::with('theClass', 'theTutor')
            ->where('payment_number', $id)
            ->whereNull('pay_date')
            // ->selectRaw('*, SUM(amount) as total')
            ->get();

            $this->total = $this->data->sum('amount');

        // dd($this->total);
    }

    public function uploadPayment()
    {
        // dd(pathinfo($this->receipt->getFilename(), PATHINFO_EXTENSION));
        if ($this->receipt != null) {
            Image::load($this->receipt->getRealPath())->fit(Fit::Max, 1080, 1920)->optimize()->save();
            $name = str_pad($this->data[0]->payment_number, 5, '0', STR_PAD_LEFT) . '-' . now()->format('Ymd His') . '.' . pathinfo($this->receipt->getFilename(), PATHINFO_EXTENSION);
            $filename = $this->receipt->storeAs($this->data[0]->theTutor->userData->slug, $name, 'tutor-payment');
        } else {
            return;
        }

        // dd($this->data);
        foreach($this->data as $data) {
            TutorPayment::find($data->id)->update([
                'payment_proof' => $filename,
                'pay_date' => now(),
                'pay_method' => $this->payMethod,
                'additional_info' => $this->addInfo,
            ]);
        }

        $email = [
            'to' => $this->data[0]->theTutor->userData->email,
            'email' => $this->data[0]->theTutor->userData->email,
            'tutorName' => $this->data[0]->theTutor->userData->name,
            'tutorNickname' => $this->data[0]->theTutor->userData->nickname,
            'paymentNumber' => $this->data[0]->payment_number,
            'paymentTime' => now(),
            'periode' => now()->subMonth()->format('F Y'),
        ];

        SendTutorFeePayment::dispatch($email);
            
        session()->flash('success', 'Unggah bukti pembayaran tutor berhasil - Bukti Pembayaran #' . str_pad($this->data[0]->payment_number, 5, '0', STR_PAD_LEFT));
        return $this->redirect(route('finance.tutor.fee'));
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
        return view('livewire.admin.keuangan.penggajian.tutor-receipt');
    }
}
