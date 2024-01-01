<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Payment;
use App\Models\Course;
use App\Models\CourseBase;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Response;

use Spatie\Browsershot\Browsershot;
use Spatie\Image\Manipulations;
use Intervention\Image\Facades\Image;

class BillingController extends Controller
{
    public function addBilling($id)
    {
        $course = Course::with('theTutor', 'theStudent', 'theCourse', 'theBilling')
            ->where('id', $id)
            ->whereNull('billing_id')
            ->first();

        // dd($course);

        if ($course == null) {
            session()->flash('success', 'Kelas sudah dimasukkan ke billing');
            return redirect(route('kbm.show', ['id' => $id]));
        }

        $checkBilling = Billing::where('student_id', $course->student_id)
            ->whereBetween('bill_date', [$course->date_of_event->addMonth()->startOfMonth(), $course->date_of_event->addMonth()->endOfMonth()])
            ->first();

        // dd($checkBilling);

        $lastInvoiceNumber = Billing::max('invoice_id');

        if ($lastInvoiceNumber == null) {
            $invoiceNumber = 1;
        } else {
            $invoiceNumber = $lastInvoiceNumber + 1;
        }

        // dd($invoiceNumber);

        if ($checkBilling !== null) {
            $lastAmount = $checkBilling->amount;
            $checkBilling->update([
                'amount' => $lastAmount + ($course->length / 60 * $course->price),
            ]);

            $course->update([
                'billing_id' => $checkBilling->id,
            ]);
        } else {
            $billing = Billing::create([
                'bill_date' => Carbon::now()->addMonth()->startOfMonth(),
                'due_date' => Carbon::now()->addMonth()->startOfMonth()->addDays(10),
                'amount' => ($course->length / 60 * $course->price),
                'invoice_id' => $invoiceNumber,
                'student_id' => $course->student_id,
            ]);

            $course->update([
                'billing_id' => $billing->id,
            ]);
        }

        session()->flash('success', 'Kelas berhasil ditambahkan ke billing.');
        return redirect(route('kbm.show', ['id' => $id]));
    }

    public function generateInvoice($id)
    {
        $billing = Billing::with('theClass.theTutor.userData', 'theStudent', 'theStudentData')
            ->where('id', $id)->firstOrFail();
        $filename = 'Invoice KASI ' . str_pad($billing->invoice_id, 5, '0', STR_PAD_LEFT);
        // dd($billing->theClass[0]);
        $image = Browsershot::html(view('billing.template', ['billing' => $billing])->render())
            ->waitUntilNetworkIdle()
            ->newHeadless()
            ->usePipe()
            ->mobile()
            ->fullPage()
            ->deviceScaleFactor(2)
            ->disableJavascript()
            ->device('iPhone 13 Mini landscape')
            // ->base64Screenshot();
            ->save(storage_path("app/billing/" . $filename . '.png'));
        ob_end_clean();

        // $file = Image::make($image)->save();
        // return response()->streamDownload(function () use ($file) {
        //     echo $file;
        // }, $filename, ['Content-Type: image/png']);
        return Response::download(storage_path("app/billing/" . $filename . '.png'), $filename);
    }

    public function confirmBilling($id) {
        // dd($id);
        $billing = Billing::with('thePayment', 'theStudent')
        ->where('id', $id)
        ->whereHas('thePayment')
        ->first();

        if ($billing == null) {
            session()->flash('fail', 'Pembayaran tidak ditemukan, tagihan tidak diproses');
        } else {
            $payments = Payment::where('billing_id', $billing->id)->get();
            if ($payments->sum('amount') == $billing->amount) {
                foreach ($payments as $item) {
                    $item->update(['confirm_date' => now(), 'confirmed_by' => auth()->user()->id]);
                }
                session()->flash('success', 'Pembayaran terkonfirmasi, tagihan lunas');
            } elseif ($payments->sum('amount') > $billing->amount) {
                foreach ($payments as $item) {
                    $item->update(['confirm_date' => now(), 'confirmed_by' => auth()->user()->id]);
                }
                session()->flash('warning', 'Pembayaran terkonfirmasi, tagihan lunas dengan kelebihan Rp.'. number_format($payments->sum('amount') - $billing->amount, 2, ',', '.'));
            } else {
                foreach ($payments as $item) {
                    $item->update(['confirm_date' => now(), 'confirmed_by' => auth()->user()->id]);
                }
                session()->flash('warning', 'Pembayaran terkonfirmasi, tagihan belum lunas dengan sisa kekurangan Rp.'. number_format($billing->amount - $payments->sum('amount'), 2, ',', '.'));
            }
        }

        return redirect(route('payment.student.status', ['id' => $billing->id]));
    }

    public function testPDF()
    {
        $image = Browsershot::html(view('billing.default')->render())
            ->waitUntilNetworkIdle()
            ->newHeadless()
            // ->noSandbox()
            ->usePipe()
            ->mobile()
            ->fullPage()
            ->deviceScaleFactor(2)
            ->disableJavascript()
            ->device('iPhone 13 Mini landscape')
            // ->windowSize(1080, 1920)
            // ->fit(Manipulations::FIT_CONTAIN, 1080, 480)
            // ->ignoreHttpsErrors()
            // ->timeout(500)
            // ->base64pdf();
            // ->setScreenshotType('png')
            ->base64Screenshot();
        // ->save(storage_path("app/billing/".Str::random(8).'.png'));

        // return response()->file($image);
        // ob_end_clean();
        return Image::make($image)->response();


        // Browsershot::url("https://kasi.test")
        //     ->addChromiumArguments([
        //         'font-render-hinting' => 'none',
        //         'allow-running-insecure-content',
        //         'autoplay-policy' => 'user-gesture-required',
        //         'disable-component-update',
        //         'disable-domain-reliability',
        //         'disable-features' => 'AudioServiceOutOfProcess,IsolateOrigins,site-per-process',
        //         'disable-print-preview',
        //         'disable-setuid-sandbox',
        //         'disable-site-isolation-trials',
        //         'disable-speech-api',
        //         'disable-web-security',
        //         'disable-setuid-sandbox',
        //         'disable-dev-shm-usage',
        //         'disk-cache-size' => 33554432,
        //         'enable-features' => 'SharedArrayBuffer',
        //         'hide-scrollbars',
        //         'ignore-gpu-blocklist',
        //         'in-process-gpu',
        //         'mute-audio',
        //         'no-default-browser-check',
        //         'no-pings',
        //         'no-sandbox',
        //         'no-zygote',
        //         'use-gl' => 'swiftshader',
        //         'window-size' => '1920,1080',
        //         'single-process'
        //     ])
        //     ->timeout(120000)
        //     ->waitUntilNetworkIdle()
        //     ->scale('0.8')
        //     ->format('a4')
        //     ->landscape()
        //     ->save(public_path('downloads') . '/' . 'a.pdf');
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
