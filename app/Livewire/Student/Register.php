<?php

namespace App\Livewire\Student;

use App\Jobs\SendRegisterStudent;
use App\Jobs\SendRegisterStudentEnglish;
use App\Models\Student;
use App\Models\User;
use App\Models\Guardian;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Image\Image as Image;
use Spatie\Image\Manipulations;
use Illuminate\Support\Str;
use Spatie\Image\Enums\Fit;

class Register extends Component
{
    use WithFileUploads;

    public $email, $whatsapp, $birthday, $name, $nationality = 'INDONESIAN', $nickname, $avatar, $hasGuardian = false, $showGuardian = false, $guardian, $guardians, $city, $address, $province, $eduStatus = 'educating', $eduLevel, $workTitle = 'unemployed', $workSite, $eduSite;

    public function mount()
    {
        $this->guardians = Guardian::with('userData')->get();
    }
    public function register()
    {
        // dd($this->birthday);
        $data = $this->validate([
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'whatsapp' => ['nullable', 'numeric', 'unique:users,mobile_number'],
            // 'nickname' => ['nullable', 'string', 'unique:users,nickname'],
            'name' => ['required', 'string', 'max:255'],
            'hasGuardian' => ['nullable', 'boolean'],
            'address' => ['required', 'string', 'max:512'],
            'avatar' => ['image', 'max:5120', 'nullable'],

        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah digunakan, silakan gunakan alamat email lain',
            // 'whatsapp.required' => 'Nomor Whatsapp murid tidak boleh kosong',
            'whatsapp.unique' => 'Nomor telepon sudah digunakan, silakan gunakan nomor telepon lain',
            'whatsapp.numeric' => 'Nomor telepon tidak valid',
            'address.required' => 'Alamat murid tidak boleh kosong',
            'name.required' => 'Nama murid tidak boleh kosong',
        ]);

        $base = User::create([
            'email' => $data['email'],
            'name' => $data['name'],
            'nickname' => $this->nickname,
            // 'password' => Hash::make('BelajarDuluMenginspirasiKemudian'),
            'password' => Hash::make(Carbon::createFromFormat('Y-m-d', $this->birthday)->format('dmY')),
            'mobile_number' => $data['whatsapp'],
            'birthday' => $this->birthday,
            'role' => 'MURID',
        ]);

        if ($data['avatar'] != null) {
            Image::load($this->avatar->getRealPath())->fit(Fit::Max, 1080, 1080)->optimize()->save();
            $filename = $this->avatar->store('/profile-photos', 'public');
            $base->update([
                'profile_photo_path' => $filename,
            ]);
        }

        $year = date('Y') . '%';
        // $last_nim = Student::where('nim', 'like', date('Y') . '%')->max('nim');
        $last_nim = Student::where('nim', 'like', $year)->max('nim');
        if (substr($last_nim, 4, 2) == date('m')) {
            $number = substr($last_nim, 6, 4) + 1;
        } else {
            $number = 1;
        }

        if ($data['hasGuardian'] == null) {
            $data['hasGuardian'] = 0;
        } else {
            $data['hasGuardian'] = 1;
        }

        if ($this->eduStatus = 'educating') {
            $eduStatus = 1;
        } else {
            $eduStatus = 0;
        }

        $student = Student::create([
            'user_id' => $base->id,
            'nim' => date("Y") . date('m') . str_pad($number, 4, "0", STR_PAD_LEFT),
            'has_guardian' => $data['hasGuardian'],
            'guardian_id' => $this->guardian,
            'edu_status' => $eduStatus,
            'edu_level' => $this->eduLevel,
            'edu_site' => $this->eduSite,
            'work_title' => $this->workTitle,
            'work_site' => $this->workSite,
            'nationality' => $this->nationality,
        ]);

        if ($data['email'] !== null) {
            // $expiresAt = now()->addDay();
            // $base->sendWelcomeNotification($expiresAt);
            $emailData = [
                'email' => $data['email'],
                'studentName' => $base->name,
                'studentNickname' => $base->nickname,
                'studentNIM' => $student->nim,
                'studentPassword' => $base->birthday->format('dmY')
            ];

            if ($this->nationality == 'INDONESIAN') {
                SendRegisterStudent::dispatch($emailData);
            } else {
                SendRegisterStudentEnglish::dispatch($emailData);
            }
        }


        session()->flash('success', 'Registrasi murid baru berhasil.');
        return $this->redirect(route('student.active'), navigate: true);
    }

    public function updatedEmail()
    {
        $this->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ], [
            'email.email' => 'Masukkan alamat email yang valid',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah digunakan, silakan gunakan alamat email lain',
        ]);
    }

    public function updatedWhatsapp()
    {
        $this->validate([
            'whatsapp' => ['nullable', 'numeric', 'unique:users,mobile_number'],
        ], [
            // 'whatsapp.required' => 'Nomor Whatsapp murid tidak boleh kosong',
            'whatsapp.unique' => 'Nomor telepon sudah digunakan, silakan gunakan nomor telepon lain',
        ]);
    }

    public function updatedGuardianWhatsapp()
    {
        $this->validate([
            'whatsapp' => ['required', 'numeric'],
        ], [
            'whatsapp.required' => 'Nomor Whatsapp wali murid tidak boleh kosong',
        ]);
    }

    public function updatedName()
    {
        $this->validate(['name' => ['required', 'string', 'max:255']], [
            'name.required' => 'Nama murid tidak boleh kosong',
        ]);
    }

    public function updatedGuardianName()
    {
        $this->validate(['name' => ['required', 'string', 'max:255']], [
            'name.required' => 'Nama wali murid tidak boleh kosong',
        ]);
    }

    public function updatedAddress()
    {
        $this->validate(['address' => ['required', 'string', 'max:255']], [
            'address.required' => 'Alamat murid tidak boleh kosong',
        ]);
    }

    public function updatedBirthday()
    {
        // dd($this->birthday);
        // dd(Carbon::createFromFormat('Y-m-d', $this->birthday)->format('dmY'));

    }

    public function updatedAvatar()
    {
        $this->validate(['avatar' => ['image', 'max:5120']], [
            'avatar.image' => 'Silakan masukkan file gambar',
            'avatar.max' => 'Ukuran file maksimal 5 MB',
        ]);
    }

    public function render()
    {
        return view('livewire.student.register');
    }
}
