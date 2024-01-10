<?php

namespace App\Livewire\Student;

use App\Models\Student;
use App\Models\Guardian;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\Features\SupportFileUploads\WithFileUploads as SupportFileUploadsWithFileUploads;
use Livewire\WithFileUploads;
use Spatie\Image\Image as Image;
use Spatie\Image\Manipulations;
use Illuminate\Support\Facades\File;

class Edit extends Component
{
    use SupportFileUploadsWithFileUploads;

    public $userID, $email, $whatsapp, $photo, $birthday, $name, $nickname, $nim, $user, $services = [], $avatar, $hasGuardian, $guardians, $guardianName, $guardianWhatsapp, $guardian, $city, $address, $province, $eduStatus, $eduLevel, $workTitle, $workSite, $eduSite, $existStatus;

    protected $rules = [
        'name' => ['required', 'string'],
        'mobile_number' => ['required', 'numeric'],
        'address' => ['required', 'string'],
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
        $this->hasGuardian = boolval($data->has_guardian);
        if ($this->hasGuardian == true) {
            $this->guardian = $data->guardian_id;
            $this->guardianName = $data->theGuardian->userData->name;
            $this->guardianWhatsapp = $data->theGuardian->userData->mobile_number;
        }
        $this->eduStatus = $data->getRawOriginal('edu_status');
        $this->eduLevel = $data->getRawOriginal('edu_level');
        $this->workTitle = $data->getRawOriginal('work_title');
        $this->workSite = $data->work_site;
        $this->eduSite = $data->edu_site;
        $this->whatsapp = $data->userData->mobile_number;
        $this->birthday = $data->userData->birthday->format('Y-m-d');
        $this->existStatus = $data->userData->exist_status;
        $this->guardians = Guardian::with('userData')->get();

        // dd($this->hasGuardian);
    }

    public function render()
    {
        // dd($this);
        return view('livewire.student.edit');
    }

    public function updatedPhoto()
    {
        // dd($this->photo);
        $this->validate(['photo' => ['image', 'max:5120']], [
            'avatar.image' => 'Silakan masukkan file gambar',
            'avatar.max' => 'Ukuran file maksimal 5 MB',
        ]);
        if ($this->user->userData->profile_photo_path != null || $this->user->userData->profile_photo_path != '') {
            if (File::exists(public_path('profile-photos/' . $this->user->userData->profile_photo_path))) {
                // dd('yes');
                File::delete(public_path('profile-photos/' . $this->user->userData->profile_photo_path));
            }
        }
        Image::load($this->photo->getRealPath())->fit(Manipulations::FIT_FILL, 1080, 1080)->optimize()->save();
        $filename = $this->photo->store('/profile-photos', 'public');
        $this->user->userData->update([
            'profile_photo_path' => $filename,
        ]);
        // $this->emit('photoUpdated');
    }

    public function update()
    {
        // dd($this);
        $data = $this->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->user->userData->id],
            'whatsapp' => ['nullable', 'numeric', 'unique:users,mobile_number,' . $this->user->userData->id],
            'name' => ['required', 'string', 'max:255'],
            'hasGuardian' => ['nullable', 'boolean'],
            // 'guardianName' => ['nullable', 'string'],
            // 'guardianWhatsapp' => ['nullable', 'numeric'],
            'address' => ['required', 'string', 'max:512'],
            'photo' => ['image', 'max:5120', 'nullable'],

        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah digunakan, silakan gunakan alamat email lain',
            // 'whatsapp.required' => 'Nomor Whatsapp murid tidak boleh kosong',
            'whatsapp.unique' => 'Nomor telepon sudah digunakan, silakan gunakan nomor telepon lain',
            'whatsapp.numeric' => 'Nomor telepon tidak valid',
            'address.required' => 'Alamat murid tidak boleh kosong',
            'name.required' => 'Nama murid tidak boleh kosong',
        ]);

        $this->user->userData->update([
            'email' => $data['email'],
            'name' => $data['name'],
            'nickname' => $this->nickname,
            // 'password' => Hash::make('BelajarDuluMenginspirasiKemudian'),
            'mobile_number' => $data['whatsapp'],
            'birthday' => $this->birthday,
            'exist_status' => $this->existStatus,
        ]);



        if ($data['hasGuardian'] == true) {
            $data['hasGuardian'] = 1;
        } else {
            $data['hasGuardian'] = 0;
        }

        $this->user->update([
            'has_guardian' => $data['hasGuardian'],
            'guardian_id' => $this->guardian,
            'edu_status' => $this->eduStatus,
            'edu_level' => $this->eduLevel,
            'edu_site' => $this->eduSite,
            'work_title' => $this->workTitle,
            'work_site' => $this->workSite,
        ]);

        // $this->user->push();


        session()->flash('success', 'Pembaruan data murid berhasil.');
        return $this->redirect(route('student.show', ['nim' => $this->user->nim]), navigate: false);
    }

    public function deleteProfilePhoto()
    {
        if ($this->user->userData->profile_photo_path != null || $this->user->userData->profile_photo_path != '') {
            if (File::exists(public_path('profile-photos/' . $this->user->userData->profile_photo_path))) {
                // dd('yes');
                File::delete(public_path('profile-photos/' . $this->user->userData->profile_photo_path));
            }
            $this->user->userData->update([
                'profile_photo_path' => null,
            ]);
        }
    }
}
