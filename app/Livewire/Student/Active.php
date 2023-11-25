<?php

namespace App\Livewire\Student;

use App\Models\Student;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Active extends Component
{

    use WithPagination;

    public $search;

    public function render()
    {
        // sleep(1);
        return view('livewire.student.active', [
            'students' => Student::with('userData')
            ->join('users','users.id','=','students.user_id')
            ->search('nim', $this->search)
            ->orSearch('users.name', $this->search)
            ->orSearch('users.mobile_number', $this->search)
            ->orSearch('users.email', $this->search)
            ->orSearch('guardian_contact', $this->search)
            ->orSearch('parent_name', $this->search)
            ->orderBy('nim', 'asc')
            ->paginate(50)
            // 'students' => Student::with('userData')->where('nim', 2023110002)->get()
        ]);
    }
}
