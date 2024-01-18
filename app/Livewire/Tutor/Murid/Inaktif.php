<?php

namespace App\Livewire\Tutor\Murid;

use App\Models\Course;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

class Inaktif extends Component
{

    use WithPagination;

    public $search;

    public function render()
    {
        // sleep(1);
        $students = Course::where('tutor_id', auth()->user()->theTutor->id)->groupBy('student_id')->get()->pluck('student_id');
        // dd($students);
        $data = Student::with('userData', 'theGuardian')
        ->join('users', 'users.id', '=', 'students.user_id')
        ->search('nim', $this->search)
        ->orSearch('users.name', $this->search)
        ->orSearch('users.mobile_number', $this->search)
        ->orSearch('users.email', $this->search)
        // ->orSearch('guardian_contact', $this->search)
        // ->orSearch('parent_name', $this->search)
        ->orderBy('nim', 'asc')
        ->whereIn('exist_status', ['Berhenti Sementara', 'Berhenti Permanen'])
        ->whereIn('students.id', $students)
        ->paginate(50);
        // dd($data);
        return view('livewire.tutor.murid.inaktif', [
            'students' => $data
        ]);
    }
}
