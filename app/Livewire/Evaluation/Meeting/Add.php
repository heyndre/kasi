<?php

namespace App\Livewire\Evaluation\Meeting;

use App\Models\Course;
use Livewire\Component;

class Add extends Component
{
    public $courseID, $course;

    public function mount($id) {
        $this->courseID = $id;
    }

    public function render()
    {
        $this->course = Course::where('id', $this->courseID)->firstOrFail();
        dd($this);

        return view('livewire.evaluation.meeting.add');
    }
}
