<?php

namespace App\Livewire\Guardian\Kelas;

use App\Models\Course;
use App\Models\Student;
use App\Models\Tutor;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

Class Index extends Component
{

    use WithPagination;

    public $searchToday, $searchTomorrow, $searchPast;
    // $searchPastTutor, $searchPastCourse, $searchPastStudent, $searchPastDate, $searchTTutor, $searchTDate, $searchTStudent, $searchTCourse;

    public function render()
    {
        $children = auth()->user()->theGuardian->theChildren->pluck('id');
        $key = $this->searchToday;
        $today = Course::with('theTutor', 'theStudent', 'theCourse')
        ->whereDate('date_of_event', Carbon::today())
        ->whereHas('theCourse', function($q) use ($key) {
            $q->search('name', $key)
            ->orderBy('name', 'asc');
        })
        ->whereIn('student_id', $children)
        // ->orWhereHas('theTutor', function($q) use ($key) {
        //     $q->search('name', $key)
        //     ->orderBy('name', 'asc');
        // })
        ->orderBy('date_of_event')
        ->get();

        $tomorrow = Course::with('theTutor', 'theStudent', 'theCourse')
        ->whereDate('date_of_event', '>' ,Carbon::today())
        ->whereIn('student_id', $children)
        // ->whereHas('theCourse', function($q) use ($sCourse) {
        //     $q->search('name', $sCourse)
        //     ->orderBy('name', 'asc');
        // })
        ->orderBy('date_of_event')
        ->paginate(15);

        $past = Course::with('theTutor', 'theStudent', 'theCourse')
        ->whereDate('date_of_event', '<', Carbon::today())
        ->whereIn('student_id', $children)
        // ->whereHas('theCourse', function($q) use ($sCourse) {
        //     $q->search('name', $sCourse)
        //     ->orderBy('name', 'asc');
        // })
        ->orderBy('date_of_event', 'desc')
        ->paginate(15);

        return view('livewire.guardian.kelas.index', [
            'today' => $today,
            'past' => $past,
            'tomorrow' => $tomorrow,
        ]);
    }
}
