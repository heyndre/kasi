<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Course;
use App\Models\TutorPayment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getClasses($status)
    {
        $data = Course::where('status', $status)->count();

        return $data;
    }

    public function getPeriodClasses($status)
    {
        $data = Course::where('status', $status)->whereBetween('date_of_event', [now()->startOfMonth(), now()->endOfMonth()])->count();

        return $data;
    }

    public function getFinance($type)
    {
        switch ($type) {
            case 'GROSSPROFIT':
                $data = Billing::with('thePayment')
                    ->whereHas('thePayment')->sum('amount');

                return $data;
                break;

            case 'TUTORPAYMENT':
                $data = TutorPayment::whereNotNull('pay_date')
                    ->sum('amount');

                return $data;
                break;

            case 'NETPROFIT':
                $data = Billing::with('thePayment')
                    ->whereHas('thePayment')
                    ->sum('amount')
                    -
                    TutorPayment::whereNotNull('pay_date')
                    ->sum('amount');

                return $data;
                break;


            case 'GROSSPROFITPERIOD':
                $data = Billing::with('thePayment')
                    ->whereHas('thePayment')
                    ->whereBetween('bill_date', [now()->startOfMonth(), now()->endOfMonth()])
                    ->sum('amount');

                return $data;
                break;

            case 'TUTORPAYMENTPERIOD':
                $data = TutorPayment::whereNotNull('pay_date')
                    ->whereBetween('due_date', [now()->startOfMonth(), now()->endOfMonth()])
                    ->sum('amount');

                return $data;
                break;

            case 'NETPROFITPERIOD':
                $data = Billing::with('thePayment')
                    ->whereHas('thePayment')
                    ->whereBetween('bill_date', [now()->startOfMonth(), now()->endOfMonth()])
                    ->sum('amount')
                    -
                    TutorPayment::whereNotNull('pay_date')
                    ->whereBetween('due_date', [now()->startOfMonth(), now()->endOfMonth()])
                    ->sum('amount');

                return $data;
                break;

            case 'LASTGROSSPROFIT':
                $data = Billing::with('thePayment')
                    ->whereHas('thePayment')
                    ->whereBetween('bill_date', [now()->subMonthNoOverflow()->startOfMonth(), now()->subMonthNoOverflow()->endOfMonth()])
                    ->sum('amount');

                return $data;
                break;

            case 'LASTTUTORPAYMENT':
                $data = TutorPayment::whereNotNull('pay_date')
                    ->whereBetween('due_date', [now()->subMonthNoOverflow()->startOfMonth(), now()->subMonthNoOverflow()->endOfMonth()])
                    ->sum('amount');

                return $data;
                break;

            case 'LASTNETPROFIT':
                $data = Billing::with('thePayment')
                    ->whereHas('thePayment')
                    ->whereBetween('bill_date', [now()->subMonthNoOverflow()->startOfMonth(), now()->subMonthNoOverflow()->endOfMonth()])
                    ->sum('amount')
                    -
                    TutorPayment::whereNotNull('pay_date')
                    ->whereBetween('due_date', [now()->subMonthNoOverflow()->startOfMonth(), now()->subMonthNoOverflow()->endOfMonth()])
                    ->sum('amount');

                return $data;
                break;

            default:
                # code...
                break;
        }
    }
}
