<?php

namespace App\Livewire\Student;

use App\Models\Student;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Edit extends Component
{

    public $title, $description, $submit, $user, $nim, $name, $whatsapp, $address, $email, $guardianName;

    protected $rules = [
        'name' => ['required','string'],
        'mobile_number' => ['required','numeric'],
        'address' => ['required','string'],
        'email' => ['required', 'string'],
    ];

    public function mount($nim)
    {
        $data = Student::with('userData')->where('nim', $nim)->first();
        $this->nim = $nim;
        $this->user = $data;
        $this->email = $data->userData->email;
        $this->name = $data->userData->name;
        $this->address = $data->address;
        $this->guardianName = $data->guardian_name;
    }

    public function render()
    {
        return view('livewire.student.edit');
    }
}
