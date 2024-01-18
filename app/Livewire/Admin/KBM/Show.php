<?php

namespace App\Livewire\Admin\KBM;

use App\Models\Billing;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Tutor;
use App\Models\TutorPayment;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use App\Jobs\SendStudentAttendance;
use App\Jobs\SendTutorAttendance;
use Livewire\Component;

class Show extends Component
{
    public $course, $billing, $payment, $tutorSharing, $meetingLink, $link, $billingStatus, $invoiceNumber, $billingDate, $studentPayment, $studentPaymentID, $tutorPaymentID, $tutorPayment, $tutorPaymentDate, $tutorPaymentReceipt;

    public function mount($id)
    {
        $this->course = Course::with('theTutor', 'theStudent', 'theCourse', 'theBilling',)
            ->where('id', $id)
            ->firstOrFail();

        $this->link = Setting::where('key', 'default_link')->first()->value;
        // dd($this->link);
        $this->billing = $this->course->theBilling;

        if ($this->course->meeting_link !== null && $this->course->meeting_link !== '') {
            $this->meetingLink = $this->course->meeting_link;
        } else {
            $this->meetingLink = Setting::where('key', 'default_link')->first()->value;
        }

        if ($this->course->theBilling) {
            $this->billingDate = $this->billing->bill_date->format('d M Y H:i T');
            $this->billingStatus = 'Ditagih';
            $this->invoiceNumber = str_pad($this->billing->invoice_id, 5, '0', STR_PAD_LEFT);

            $this->payment = Payment::where('billing_id', $this->billing->id)->first();
            $this->tutorSharing = TutorPayment::where('billing_id', $this->billing->id)->first();
        } else {
            $this->billingStatus = 'Belum ditagih';
            $this->billingDate = 'N/A';
            $this->invoiceNumber = 'N/A';
        }

        if ($this->payment) {
            $this->studentPayment = 'Lunas';
            $this->studentPaymentID = $this->payment->id;
        } else {
            $this->studentPayment = 'Belum Lunas';
            $this->studentPaymentID = 'N/A';
        }

        if ($this->tutorSharing) {
            $this->tutorPayment = 'Terbayar';
            $this->tutorPaymentDate = $this->tutorSharing->pay_date->format('d M Y H:i T');
            $this->tutorPaymentReceipt = $this->tutorSharing->id;
        } else {
            $this->tutorPayment = 'Belum terbayar';
            $this->tutorPaymentDate = 'N/A';
            $this->tutorPaymentReceipt = 'N/A';
        }
    }

    public function cancelClass()
    {
        $this->course->update([
            'status' => 'CANCELLED'
        ]);
        session()->flash('warning', 'Status kelas dibatalkan.');
        return $this->redirect(route('kbm.show', ['id' => $this->course->id]), navigate: false);
    }

    public function finishClass()
    {
        $this->course->update([
            'status' => 'CONDUCTED'
        ]);
        session()->flash('success', 'Status kelas diselesaikan.');
        return $this->redirect(route('kbm.show', ['id' => $this->course->id]), navigate: false);
    }

    public function burnClass()
    {
        $this->course->update([
            'status' => 'BURNED'
        ]);
        session()->flash('success', 'Status kelas diselesaikan tanpa kehadiran murid.');
        return $this->redirect(route('kbm.show', ['id' => $this->course->id]), navigate: false);
    }

    public function render()
    {
        return view('livewire.admin.kbm.show');
    }

    public function studentAttendance()
    {
        if (auth()->user()->role !== 'MURID') {
            return 'Murid tidak ditemukan';
        }

        $this->course->update([
            'student_attendance' => now(),
        ]);
        $recipients = User::management()->get();
        // dd($recipients);
        foreach($recipients as $to) {
            // dd($to->email);
            $data = [
                'email' => $to->email,
                'classDate' => $this->course->date_of_event->format('d/m/Y H:i T'),
                'studentAttendance' => $this->course->student_attendance->format('d/m/Y H:i T'),
                'studentAttendanceDiff' => $this->course->student_attendance->diffForHumans($this->course->date_of_event,
                    \Carbon\CarbonInterface::DIFF_RELATIVE_AUTO, false, 2),
                'studentName' => $this->course->theStudent->userData->name,
                'studentNIM' => $this->course->theStudent->nim,
                'tutorName' => $this->course->theTutor->userData->name,
                'className' => $this->course->theCourse->name,
                'classID' => $this->course->id
            ];
            SendStudentAttendance::dispatch($data);
        }

        session()->flash('success', 'Kehadiran tercatat, selamat belajar di KASI!');
    }

    public function tutorAttendance()
    {
        if (auth()->user()->role !== 'TUTOR') {
            return 'Tutor tidak ditemukan';
        }

        $this->course->update([
            'tutor_attendance' => now(),
        ]);
        
        $recipients = User::management()->get();
        foreach($recipients as $to) {
            $data = [
                'email' => $to->email,
                'classDate' => $this->course->date_of_event->format('d/m/Y H:i T'),
                'tutorAttendance' => $this->course->tutor_attendance->format('d/m/Y H:i T'),
                'tutorAttendanceDiff' => $this->course->tutor_attendance->diffForHumans($this->course->date_of_event,
                    \Carbon\CarbonInterface::DIFF_RELATIVE_AUTO, false, 2),
                'studentName' => $this->course->theStudent->userData->name,
                'studentNIM' => $this->course->theStudent->nim,
                'tutorName' => $this->course->theTutor->userData->name,
                'className' => $this->course->theCourse->name,
                'classID' => $this->course->id
            ];
            SendTutorAttendance::dispatch($data);
        }

        session()->flash('success', 'Kehadiran tercatat, selamat mengajar di KASI!');
    }
}
