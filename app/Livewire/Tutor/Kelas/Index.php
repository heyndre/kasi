<?php

namespace App\Livewire\Tutor\Kelas;

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
        $key = $this->searchToday;
        $today = Course::with('theTutor', 'theStudent', 'theCourse')
        ->whereDate('date_of_event', Carbon::today())
        ->whereHas('theCourse', function($q) use ($key) {
            $q->search('name', $key)
            ->orderBy('name', 'asc');
        })
        ->where('tutor_id', auth()->user()->theTutor->id)
        // ->orWhereHas('theTutor', function($q) use ($key) {
        //     $q->search('name', $key)
        //     ->orderBy('name', 'asc');
        // })
        ->orderBy('date_of_event')
        ->get();

        $tomorrow = Course::with('theTutor', 'theStudent', 'theCourse')
        ->whereDate('date_of_event', '>' ,Carbon::today())
        ->where('tutor_id', auth()->user()->theTutor->id)
        // ->whereHas('theCourse', function($q) use ($sCourse) {
        //     $q->search('name', $sCourse)
        //     ->orderBy('name', 'asc');
        // })
        ->orderBy('date_of_event')
        ->paginate(15);

        $past = Course::with('theTutor', 'theStudent', 'theCourse')
        ->whereDate('date_of_event', '<', Carbon::today())
        ->where('tutor_id', auth()->user()->theTutor->id)
        // ->whereHas('theCourse', function($q) use ($sCourse) {
        //     $q->search('name', $sCourse)
        //     ->orderBy('name', 'asc');
        // })
        ->orderBy('date_of_event', 'desc')
        ->paginate(15);

        return view('livewire.tutor.kelas.index', [
            'today' => $today,
            'past' => $past,
            'tomorrow' => $tomorrow,
        ]);
    }
}
