<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Course;
use App\Models\TutorPayment;
use Illuminate\Http\Request;
use  alchemyguy\YoutubeLaravelApi\AuthenticateService;
use  alchemyguy\YoutubeLaravelApi\VideoService;
use GuzzleHttp\Psr7\MimeType;

class DashboardController extends Controller
{

    public function initYoutube()
    {
        $authObject  = new AuthenticateService;

        # Replace the identifier with a unqiue identifier for account or channel
        $authUrl = $authObject->getLoginUrl('kangenmenginspirasi@gmail.com', 'UCy_AafU9lcTV6fg7yNv2CTQ');

        dd($authUrl);
        redirect($authUrl);
    }

    public function googleRedirect(Request $request)
    {
        $code = $request->query('code');
        $identifier = $request->query('state');
        // $code = '4/0ATx3LY5vpXAM3pgLfFe8JrJbBLOPPi4z43_oKowvM9t4V4CHdIV_o8mBLtgnYRbzrw7GmQ';
        // $identifier = 'UCy_AafU9lcTV6fg7yNv2CTQ';

        $authObject  = new AuthenticateService;
        $authResponse = $authObject->authChannelWithCode($code);

        dd($authResponse);
    }

    public function testYoutube()
    {
        $googleToken = [
            'access_token' => "ya29.a0AXooCgsZtetSRQIDDuAwXU08aONcBiQUWIAWMOSS4Yvf0ONxRoZYS0I1wamxn9y_lqNYhVmc3yDT4Q5NX0iMNjAubjVk5RFbT-HRwVRus1RUylABFXVd3f6y_laMx_xybpeevYd0TFCt7MK2oh8NNDvVMbRI-d9GjCE8aCgYKAaUSARMSFQHGX2MiIHL2x5M-3fiyL1NH_9Z0RQ0171",
            'refresh_token' => "1//0gBZ7AsobJfEzCgYIARAAGBASNwF-L9IrgpW3EGutxNAakxKO0-LIEBBWq09VvQYyCCxuWeamVM2FpnhF0dVtz_RR5VUB7sleujs",
            "token_type" => "Bearer",
        ];
        /*
        * $videoPath  	path to the video
        * $data   		array('title'=>"",
        *					'description'=>"",
        *					'tags'=>"",
        *					'category_id'=>"",
        *					'video_status'=>"")
        */

        $videoPath = storage_path("app\classes\Recording\Levana - Gibong - 24 June 2024.mp4");
        $data = [
            'title' => "Levana - Gibong - 24 Juni 2024",
            'description' => "",
            'tags' => "",
            'category_id' => "",
            'video_status' => "unlisted"
        ];

        // dd($videoPath);
        // $mime_type = MimeType::fromExtension($videoPath);
        // return response()->file($videoPath, [
        //     'Content-Type' => $mime_type,
        //     'Content-Disposition' => 'inline; filename="Lesson-file"'
        // ]);
        $videoServiceObject  = new VideoService;
        $response = $videoServiceObject->uploadVideo($googleToken, $videoPath, $data);

        dd($response);
    }

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
