<?php

namespace App\Http\Controllers;

use App\Jobs\SendTutorFeeInfo;
use App\Models\Course;
use App\Models\Setting;
use App\Models\Tutor;
use App\Models\TutorPayment;
use Illuminate\Http\Request;

class MeetingController extends Controller
{

    public function finishClass($id)
    {
        $course = Course::where('id', $id)->where('status', 'WAITING')->firstOrFail();
        $course->update([
            'tutor_finish_confirm' => now()
        ]);
    }

    public function studentAttendance($id)
    {
        if (auth()->user()->role !== 'MURID') {
            return 'Murid tidak ditemukan';
        }

        $course = Course::where('id', $id)
            ->where('student_id', auth()->user()->theStudent->id)
            ->firstOrFail();
        $course->update([
            'student_attendance' => now(),
        ]);
        if ($course->meeting_link !== null && $course->meeting_link !== '') {
            return redirect($course->meeting_link);
        } else {
            return redirect(Setting::where('key', 'default_link')->first()->value);
        }
    }

    public function tutorAttendance($id)
    {
        if (auth()->user()->role !== 'TUTOR') {
            return 'Tutor tidak ditemukan';
        }

        $course = Course::where('id', $id)
            ->where('tutor_id', auth()->user()->theTutor->id)
            ->firstOrFail();
        $course->update([
            'tutor_attendance' => now(),
        ]);
        if ($course->meeting_link !== null && $course->meeting_link !== '') {
            return redirect($course->meeting_link);
        } else {
            return redirect(Setting::where('key', 'default_link')->first()->value);
        }
    }

    public function tesFee()
    {
        $tutorsID = Course::whereNull('tutor_payment_id')
            ->whereIn('status', ['BURNED', 'CONDUCTED'])
            ->groupBy('tutor_id')
            ->pluck('tutor_id');

        // dd($tutorsID);

        foreach ($tutorsID as $id) {
            $tutor = Tutor::with('userData')->where('id', $id)->first();
            $unpaidClasses = Course::with('theTutor.userData', 'theSharing')
                ->where('tutor_id', $id)
                ->whereNull('tutor_payment_id')
                ->whereIn('status', ['BURNED', 'CONDUCTED'])
                ->get();

            $totalPrice = 0;
            $totalMinutes = 0;
            $period = now()->subMonth()->format('F Y');

            $lastInvoiceNumber = TutorPayment::max('payment_number');

            if ($lastInvoiceNumber == null) {
                $lastInvoiceNumber = 0;
                $invoiceNumber = $lastInvoiceNumber + 1;
                // dd('start 1');
            } else {
                $invoiceNumber = $lastInvoiceNumber + 1;
            }

            foreach ($unpaidClasses as $item) {
                // dd($item);
                $price = ($item->price * ($item->length / 60)) * 75 / 100;
                $totalPrice += $price;
                $totalMinutes += $item->length;

                $paymentData = TutorPayment::create([
                    'class_id' => $item->id,
                    'tutor_id' => $item->tutor_id,
                    'amount' => $price,
                    'due_date' => now(),
                    'payment_number' => $invoiceNumber,
                ]);

                Course::where('id', $item->id)
                    ->update([
                        'tutor_payment_id' => $paymentData->id
                    ]);
            }


            if ($tutor->userData->email != null) {
                $data = [
                    'email' => $tutor->userData->email,
                    'tutorName' => $tutor->userData->name,
                    'tutorNickname' => $tutor->userData->nickname,
                    'totalFee' => $totalPrice,
                    'totalMinutes' => $totalMinutes,
                    'periode' => $period,
                ];
                // SendTutorFeeInfo::dispatch($data);
            }
        }
    }
}
