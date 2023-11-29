<?php

namespace App\Livewire\Student;

use App\Models\Student;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Spatie\Image\Image as Image;
use Spatie\Image\Manipulations;

class Edit extends Component
{

    public $userID, $email, $whatsapp, $birthday, $name, $nim, $user, $avatar, $hasGuardian = false, $showGuardian = false, $guardianName, $guardianWhatsapp, $city, $address, $province, $eduStatus, $eduLevel, $workTitle, $workSite, $eduSite;

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
        $this->guardianWhatsapp = $data->guardian_contact;
        $this->eduStatus = $data->getRawOriginal('edu_status');
        $this->eduLevel = $data->getRawOriginal('edu_level');
        $this->workTitle = $data->getRawOriginal('work_title');
        $this->workSite = $data->work_site;
        $this->eduSite = $data->edu_site;
        $this->whatsapp = $data->userData->mobile_number;
        $this->birthday = $data->userData->birthday->format('Y-m-d');
        // dd($this);
    }

    public function render()
    {
        return view('livewire.student.edit');
    }

    public function update()
    {
        // dd($this);
        $data = $this->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$this->user->userData->id],
            'whatsapp' => ['required', 'numeric', 'unique:users,mobile_number,'.$this->user->userData->id],
            'name' => ['required', 'string', 'max:255'],
            'hasGuardian' => ['nullable', 'boolean'],
            'guardianName' => ['nullable', 'string'],
            'guardianWhatsapp' => ['nullable', 'numeric'],
            'address' => ['required', 'string', 'max:512'],
            'avatar' => ['image', 'max:5120', 'nullable'],

        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah digunakan, silakan gunakan alamat email lain',
            'whatsapp.required' => 'Nomor Whatsapp murid tidak boleh kosong',
            'whatsapp.unique' => 'Nomor telepon sudah digunakan, silakan gunakan nomor telepon lain',
            'whatsapp.numeric' => 'Nomor telepon tidak valid',
            'address.required' => 'Alamat murid tidak boleh kosong',
            'name.required' => 'Nama murid tidak boleh kosong',
        ]);

        $this->user->userData->update([
            'email' => $data['email'],
            'name' => $data['name'],
            // 'password' => Hash::make('BelajarDuluMenginspirasiKemudian'),
            'mobile_number' => $data['whatsapp'],
            'birthday' => $this->birthday,
        ]);

        if ($data['avatar'] != null) {
            Image::load($this->avatar->getRealPath())->fit(Manipulations::FIT_FILL, 1080, 1080)->optimize()->save();
            $filename = $this->avatar->store('/profile-photos', 'public');
            $this->user->userData->update([
            'profile_photo_path' => $filename,
            ]);
        }

        if ($data['hasGuardian'] == null) {
            $data['hasGuardian'] = 0;
        } else {
            $data['hasGuardian'] = 1;
        }

        $this->user->update([
            'has_guardian' => $data['hasGuardian'],
            'guardian_name' => $data['guardianName'],
            'guardian_contact' => $data['guardianWhatsapp'],
            'edu_status' => $this->eduStatus,
            'edu_level' => $this->eduLevel,
            'edu_site' => $this->eduSite,
            'work_title' => $this->workTitle,
            'work_site' => $this->workSite,
        ]);

        // $this->user->push();


        session()->flash('success', 'Pemutakhiran data murid berhasil.');
        return $this->redirect(route('student.show', ['nim' => $this->user->nim]), navigate: false);
    }
}
