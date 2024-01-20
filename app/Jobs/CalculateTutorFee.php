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
    public function handle(): void
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

            foreach ($unpaidClasses as $item) {
                // dd($item);
                $price = ($item->price * ($item->length / 60)) * 75 / 100;
                $totalPrice += $price;
                $totalMinutes += $item->length;

                $paymentData = TutorPayment::create([
                    'class_id' => $item->id,
                    'tutor_id' => $item->tutor_id,
                    'amount' => $price,
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
                SendTutorFeeInfo::dispatch($data);
            }
        }
    }
}
