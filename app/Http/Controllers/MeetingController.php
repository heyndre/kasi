<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Setting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{

    public function finishClass($id) {
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
}
