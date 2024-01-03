<?php

namespace App\Livewire\Admin\Keuangan\Refund;

use App\Models\Billing;
use App\Models\Expense;
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

class UploadReceipt extends Component
{
    use WithFileUploads;

    public $receipt, $data, $payMethod = 'bank_transfer', $addInfo;

    public function mount($id)
    {
        $this->data = Expense::with('theBill')
            ->where('id', $id)
            ->firstOrFail();
    }

    public function uploadPayment()
    {
        // dd(pathinfo($this->receipt->getFilename(), PATHINFO_EXTENSION));
        if ($this->receipt != null) {
            Image::load($this->receipt->getRealPath())->fit(Manipulations::FIT_FILL_MAX, 1080, 1920)->optimize()->save();
            $name = str_pad($this->data->id, 5, '0', STR_PAD_LEFT) . '-' . now()->format('Ymd His') . '.' . pathinfo($this->receipt->getFilename(), PATHINFO_EXTENSION);
            $filename = $this->receipt->storeAs($this->data->theBill->theStudent->nim, $name, 'student-refund');
        } else {
            return;
        }

        $this->data->update([
            'payment_file' => $filename,
            'spent_date' => now(),
            'additional_info' => $this->addInfo,
        ]);

        session()->flash('success', 'Unggah bukti pengembalian dana berhasil - Bukti Pembayaran #' . str_pad($this->data->id, 5, '0', STR_PAD_LEFT));
        return $this->redirect(route('payment.student.status', ['id' => $this->data->billing_id]));
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
        return view('livewire.admin.keuangan.refund.upload-receipt');
    }
}
