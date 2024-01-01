<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Image;

class FileAccessController extends Controller
{
    public function accessClassPhoto($file)
    {
        // $path = Storage::disk('class-photo')->path($file);
        // $type = Storage::disk('class-photo')->mimeType($file);
        // header('Content-Type:' . $type);
        // header('Content-Length: ' . filesize($path));
        ob_end_clean();
        return response()->file(storage_path('app/classes/photo/' . $file));
    }

    public function accessStudentReceipt($nim, $filename)
    {
        // return storage_path('app/billing/student-payment-receipt/'.$file);
        ob_end_clean();
        return response()->file(storage_path('app/billing/student-payment-receipt/' . $nim . '/' . $filename));
    }
}
