<?php

namespace App\Livewire\Admin\KBM;

use App\Models\Billing;
use App\Models\Course;
use App\Models\Package;
use App\Models\Student;
use App\Models\Tutor;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

class StatusIndex extends Component
{

    use WithPagination;

    public $searchToday, $searchTomorrow, $searchPast;
    // $searchPastTutor, $searchPastCourse, $searchPastStudent, $searchPastDate, $searchTTutor, $searchTDate, $searchTStudent, $searchTCourse;

    public function AddAllToBilling()
    {
        $unbilled = Course::with('theTutor', 'theStudent', 'theCourse')
            ->whereNull('billing_id')
            ->whereNot('status', 'CANCELLED')
            ->whereNot('status', 'WAITING')
            ->whereNot('status', 'RUNNING')
            ->whereNot('status', 'NEEDCONFIRMATION')
            ->orderBy('date_of_event')
            ->get();

        foreach ($unbilled as $key => $value) {
            $id = $value->id;
            $c = Course::findOrfail($id)->status;
            // dd($c);
            if ($c == 'CANCELLED') {
                session()->flash('warning', 'Kelas dibatalkan, tidak ditambahkan ke billing');
                return redirect(route('kbm.show', ['id' => $id]));
            }

            $course = Course::with('theTutor', 'theStudent', 'theCourse', 'theBilling')
                ->where('id', $id)
                ->whereNull('billing_id')
                ->first();

            // dd($course);
            // dd($course->date_of_event->addMonthsNoOverflow(1)->startOfMonth());

            if ($course == null) {
                session()->flash('success', 'Kelas sudah dimasukkan ke billing');
                return redirect(route('kbm.show', ['id' => $id]));
            }

            $checkBilling = Billing::where('student_id', $course->student_id)
                // ->billBetween([$course->date_of_event->addMonth()->startOfMonth(), $course->date_of_event->addMonth()->endOfMonth()])
                ->whereBetween('bill_date', [$course->date_of_event->addMonthsNoOverflow(1)->startOfMonth(), $course->date_of_event->addMonthsNoOverflow(1)->endOfMonth()])
                // ->whereBetween('bill_date', [Carbon::create($course->date_of_event->format('Y-m-01'))->addMonth(), Carbon::create($course->date_of_event->format('Y-m-t'))->addMonth()->endOfMonth()])
                // ->whereBetween('bill_date', [now()->addMonth()->startOfMonth(), now()->addMonth()->endOfMonth()])
                ->first();
            // ->toRawSql();

            // dd($checkBilling);

            $lastInvoiceNumber = Billing::max('invoice_id');

            if ($lastInvoiceNumber == null) {
                $lastInvoiceNumber = 0;
                $invoiceNumber = $lastInvoiceNumber + 1;
                // dd('start 1');
            } else {
                if ($checkBilling != null) {
                    $invoiceNumber = $lastInvoiceNumber;
                    // dd('same number');
                } else {
                    $invoiceNumber = $lastInvoiceNumber + 1;
                    // dd('new number');
                }
            }

            // dd(Package::where('student_id', $course->theStudent->id)->get());

            // dd(Package::where('student_id', $course->theStudent->id)
            // ->where('expire_at', '>=', $course->date_of_event)
            // ->get());
            $availPackage = Package::where('student_id', $course->theStudent->id)
                ->where('expire_at', '>=', $course->date_of_event)
                ->get();

            // if ($course->theStudent->has('thePackage')) {
            if ($availPackage->count() > 0) {
                // dd('yes');
                // dd($course->theStudent->thePackage->where('expire_at', '>=', $course->date_of_event)->first()->price_per_unit);
                $price = $course->theStudent->thePackage->where('expire_at', '>=', $course->date_of_event)->first()->price_per_unit;
            } else {
                // dd('no');

                $price = $course->price;
            }

            // dd($invoiceNumber);

            if ($checkBilling !== null) {
                $lastAmount = $checkBilling->amount;
                $lastLength = $checkBilling->length;

                if ($course->free_trial == 0) {
                    $checkBilling->update([
                        'amount' => $lastAmount + ($course->length / 60 * $price),
                        'amount_no_promo' => $lastAmount + ($course->length / 60 * $price),
                        'length' => $lastLength + $course->length
                    ]);
                } else {
                    $checkBilling->update([
                        'amount' => $lastAmount + 0,
                        'amount_no_promo' => $lastAmount + 0,
                        'length' => $lastLength + $course->length
                    ]);
                }

                $course->update([
                    'billing_id' => $checkBilling->id,
                ]);
            } else {
                if ($course->free_trial == 0) {
                    $billing = Billing::create([
                        'bill_date' => $course->date_of_event->addMonth()->startOfMonth(),
                        'due_date' => $course->date_of_event->addMonth()->startOfMonth()->addDays(10),
                        'amount' => ($course->length / 60 * $price),
                        'amount_no_promo' => ($course->length / 60 * $price),
                        'invoice_id' => $invoiceNumber,
                        'student_id' => $course->student_id,
                        'length' => $course->length,
                    ]);
                } else {
                    $billing = Billing::create([
                        'bill_date' => $course->date_of_event->addMonth()->startOfMonth(),
                        'due_date' => $course->date_of_event->addMonth()->startOfMonth()->addDays(10),
                        'amount' => 0,
                        'amount_no_promo' => 0,
                        'invoice_id' => $invoiceNumber,
                        'student_id' => $course->student_id,
                        'length' => $course->length,
                    ]);
                }

                $course->update([
                    'billing_id' => $billing->id,
                ]);
            }
        }

        session()->flash('success', $key . ' Kelas berhasil ditambahkan ke billing.');
        // return redirect(route('kbm.show', ['id' => $id]));
    }

    public function render()
    {
        $key = $this->searchToday;
        $unbilled = Course::with('theTutor', 'theStudent', 'theCourse')
            ->whereHas('theStudent.userData', function ($q) use ($key) {
                $q->search('name', $key)
                    ->orderBy('name', 'asc');
            })
            ->whereNull('billing_id')
            ->whereNot('status', 'CANCELLED')
            // ->orWhereHas('theTutor', function($q) use ($key) {
            //     $q->search('name', $key)
            //     ->orderBy('name', 'asc');
            // })
            ->orderBy('date_of_event')
            ->paginate(15);

        $key = $this->searchTomorrow;
        $billed = Course::with('theTutor', 'theStudent', 'theCourse')
            ->whereNotNull('billing_id')
            ->whereHas('theCourse', function ($q) use ($key) {
                $q->search('name', $key)
                    ->orderBy('name', 'asc');
            })
            ->orderBy('date_of_event', 'desc')
            ->paginate(15);

        return view('livewire.admin.kbm.status-index', [
            'unbilled' => $unbilled,
            'billed' => $billed,
        ]);
    }
}
