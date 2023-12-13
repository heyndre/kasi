<?php

namespace App\Livewire\Tutor;

use App\Models\Student;
use App\Models\Tutor;
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
        return view('livewire.tutor.active', [
            'tutors' => Tutor::with('userData')
            ->join('users as u','u.id','=','tutors.user_id')
            ->search('tutors.id', $this->search)
            ->orSearch('u.name', $this->search)
            ->orSearch('u.mobile_number', $this->search)
            ->orSearch('u.email', $this->search)
            ->where('exist_status', 'Aktif')
            ->orWhere('exist_status', 'Reaktivasi')
            ->paginate(50)
            // 'students' => Student::with('userData')->where('nim', 2023110002)->get()
        ]);
    }
}
