<?php

namespace App\Jobs;

use App\Models\Course;
use App\Models\Tutor;
use App\Models\TutorPayment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CalculateTutorFee implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $tutorsID = Course::whereNull('tutor_payment_id')
            ->whereNotNull('billing_id')
            ->whereIn('status', ['BURNED', 'CONDUCTED'])
            ->groupBy('tutor_id')
            ->pluck('tutor_id');

        // dd($tutorsID);
        // $returnData = [];

        foreach ($tutorsID as $id) {
            $tutor = Tutor::with('userData')->where('id', $id)->first();
            $unpaidClasses = Course::with('theTutor.userData', 'theSharing')
                ->where('tutor_id', $id)
                ->whereNull('tutor_payment_id')
                ->whereNotNull('billing_id')
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

            // $returnData[$key] = ['tutor_id' => $id];

            foreach ($unpaidClasses as $item) {
                // dd($item);
                if ($item->free_trial == 1) {
                    $price = ($item->price_idr * ($item->length / 60)) * 50 / 100;
                } else {
                    $price = ($item->price_idr * ($item->length / 60)) * 75 / 100;
                }
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

                // $returnData[$key][$id] = [
                //     'class_id' => $item->id,
                //     'tutor_id' => $item->tutor_id,
                //     'amount' => $price,
                //     'due_date' => now(),
                //     'payment_number' => $invoiceNumber,
                // ];
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
                SendTutorFeeInfo::dispatch($data);
            }

            // return $returnData;
        }
    }
}
