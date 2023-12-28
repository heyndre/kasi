<?php

namespace App\Livewire\Admin\KBM;

use App\Models\Course;
use App\Models\Student;
use App\Models\Tutor;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

Class StatusIndex extends Component
{

    use WithPagination;

    public $searchToday, $searchTomorrow, $searchPast;
    // $searchPastTutor, $searchPastCourse, $searchPastStudent, $searchPastDate, $searchTTutor, $searchTDate, $searchTStudent, $searchTCourse;

    public function render()
    {
        $key = $this->searchToday;
        $unbilled = Course::with('theTutor', 'theStudent', 'theCourse')
        ->whereHas('theCourse', function($q) use ($key) {
            $q->search('name', $key)
            ->orderBy('name', 'asc');
        })
        ->whereNull('billing_id')
        // ->orWhereHas('theTutor', function($q) use ($key) {
        //     $q->search('name', $key)
        //     ->orderBy('name', 'asc');
        // })
        ->orderBy('date_of_event')
        ->paginate(15);

        $billed = Course::with('theTutor', 'theStudent', 'theCourse')
        ->whereNotNull('billing_id')
        ->whereHas('theCourse', function($q) use ($key) {
            $q->search('name', $key)
            ->orderBy('name', 'asc');
        })
        ->orderBy('date_of_event', 'desc')
        ->paginate(15);

        return view('livewire.admin.kbm.status-index', [
            'unbilled' => $unbilled,
            'billed' => $billed,
        ]);
    }
}
