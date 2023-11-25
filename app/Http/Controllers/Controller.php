<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Student;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function test() {
        $data = Student::where('nim', 'like', date('Y').'%')->max('nim');
        // $data = substr($data, 4, 2);
        // $data = substr($data, 0, 4);
        if (substr($data, 4, 2) == date('m')) {
            $number = substr($data, 6, 4) + 1;
        } else {
            $number = 1;
        }
        return date("Y").date('m').'000'.$number;
    }
}
