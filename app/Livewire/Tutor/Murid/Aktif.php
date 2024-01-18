<?php

namespace App\Livewire\Tutor\Murid;

use App\Models\Course;
use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;

class Aktif extends Component
{

    use WithPagination;

    public $search;

    public function render()
    {
        // sleep(1);
        $students = Course::where('tutor_id', auth()->user()->theTutor->id)->groupBy('student_id')->get()->pluck('student_id');
        // dd($students);
        return view('livewire.tutor.murid.aktif', [
            'students' => Student::with('userData', 'theGuardian')
                ->join('users', 'users.id', '=', 'students.user_id')
                ->search('nim', $this->search)
                ->orSearch('users.name', $this->search)
                ->orSearch('users.mobile_number', $this->search)
                ->orSearch('users.email', $this->search)
                // ->orSearch('guardian_contact', $this->search)
                // ->orSearch('parent_name', $this->search)
                ->orderBy('nim', 'asc')
                ->whereIn('exist_status', ['Aktif', 'Reaktivasi'])
                ->whereIn('students.id', $students)
                ->paginate(50)
            // 'students' => Student::with('userData')->where('nim', 2023110002)->get()
        ]);
    }
}
