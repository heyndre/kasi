<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Course;
use App\Models\CourseBase;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BillingController extends Controller
{
    public function addBilling($id)
    {
        $course = Course::with('theTutor', 'theStudent', 'theCourse', 'theBilling')
            ->where('id', $id)->first();

        // dd($course);

        if ($course->theBilling) {
            session()->flash('success', 'Data billing sudah dibuat.');
            return redirect(route('kbm.show', ['id' => $id]));
        }


        $duePeriod = Setting::where('key', 'bill_due_date')->value('value');

        $thisMonthInvoice = Billing::where('student_id', $course->student_id)
            ->whereBetween('bill_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->value('invoice_id');

        // dd($thisMonthInvoice);

        $lastMonthInvoice = Billing::where('student_id', $course->student_id)
            ->whereBetween('bill_date', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])
            ->value('invoice_id');

        // dd($lastMonthInvoice);

        if ($course->date_of_event->format('Y-m' !== date('Y-m'))) {
            if ($thisMonthInvoice !== null) {
                $invoiceID = $thisMonthInvoice;
            }
            $invoiceID = $lastMonthInvoice + 1;
        } else {
            $invoiceID = $lastMonthInvoice + 1;
        }
        // dd($invoiceID);


        $billing = Billing::create([
            'bill_date' => now(),
            'due_date' => now()->addDays($duePeriod),
            'amount' => $course->length / 60 * $course->price,
            'invoice_id' => $invoiceID,
            'class_id' => $course->id,
            'student_id' => $course->student_id,
        ]);

        session()->flash('success', 'Pembaruan data billing berhasil.');
        return redirect(route('kbm.show', ['id' => $id]));
    }

    public function updatePrice($id)
    {
        $course = Course::with('theTutor', 'theStudent', 'theCourse', 'theBilling')
            ->where('id', $id)->first();

        $price = CourseBase::where('id', $course->course_id)->value('price');
        $length = 60;
        $course->update([
            'price' => $price,
            'length' => $length,
        ]);
    }
}
