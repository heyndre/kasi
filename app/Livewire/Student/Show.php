<?php

namespace App\Livewire\Student;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;


use Livewire\Component;

class Show extends Component
{
    public $status, $nim, $acronym, $photoUrl, $acronymPlus, $name, $address, $birthday, $whatsapp, $photo, $hasGuardian, $guardianName, $guardianWhatsapp, $registeredAt, $lastLoginAt, $lastActiveAt;

    public function mount($nim)
    {
        $data = Student::with('userData')->where('nim', $nim)->firstOrFail();
        // dd($data);

        $this->name = $data->userData->name;
        $this->address = $data->address;
        $this->whatsapp = $data->userData->mobile_number;
        $this->photo = $data->userData->profile_photo_path;
        $this->registeredAt = $data->userData->created_at;
        $this->lastLoginAt = $data->userData->last_login_at;
        $this->lastActiveAt = $data->userData->last_active_at;
        $this->birthday = $data->userData->birthday;
        $this->hasGuardian = $data->has_guardian;
        $this->guardianName = $data->guardian_name;
        $this->guardianWhatsapp = $data->guardian_contact;
        $this->status = $data->userData->exist_status;

        $words = preg_split("/\s+/", $this->name);
        $this->acronym = '';
        $this->acronymPlus = '';
        foreach ($words as $w) {
            $this->acronym .= mb_substr($w, 0, 1);
            $this->acronymPlus .= mb_substr($w, 0, 1) . '+';
        }

        if ($this->photo == '') {
            $this->photoUrl = 'https://ui-avatars.com/api/?name='.$acronymPlus.'&color=7F9CF5&background=EBF4FF';
        } else {
            $this->photoUrl = asset($this->photo);
        }
    }

    public function render()
    {
        return view('livewire.student.show');
    }
}
