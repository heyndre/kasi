<?php

namespace App\Livewire\Guardian;

use App\Jobs\SendRegisterGuardian;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\User;
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

    public $email, $whatsapp, $birthday, $name, $avatar, $city, $address, $province, $eduStatus = 'educating', $eduLevel, $workTitle = 'unemployed', $workSite, $eduSite, $bankAccount, $bankName, $bankAdditionalInfo, $eduMajor, $religion, $hobbies, $passion, $motto, $teachingExp, $leadershipExp, $competitionExp;

    public function register()
    {
        // dd($this);
        $data = $this->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'whatsapp' => ['required', 'numeric', 'unique:users,mobile_number'],
            'name' => ['required', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:512'],
            'avatar' => ['image', 'max:5120', 'nullable'],

        ], [
            'email.email' => 'Masukkan alamat email yang valid',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah digunakan, silakan gunakan alamat email lain',
            'whatsapp.required' => 'Nomor Whatsapp wali murid tidak boleh kosong',
            'whatsapp.unique' => 'Nomor telepon sudah digunakan, silakan gunakan nomor telepon lain',
            'whatsapp.numeric' => 'Nomor telepon tidak valid',
            'name.required' => 'Nama wali murid tidak boleh kosong',
        ]);

        $base = User::create([
            'email' => $data['email'],
            'name' => $data['name'],
            // 'password' => Hash::make('BelajarDuluMenginspirasiKemudian'),
            'password' => Hash::make('inspirasi2024'),
            'mobile_number' => $data['whatsapp'],
            'address' => $this->address,
            'role' => 'WALI MURID',
        ]);

        // $expiresAt = now()->addDay();
        // $base->sendWelcomeNotification($expiresAt);

        if ($data['avatar'] != null) {
            Image::load($this->avatar->getRealPath())->fit(Fit::Max, 1080, 1080)->optimize()->save();
            $filename = $this->avatar->store('/profile-photos', 'public');
            $base->update([
                'profile_photo_path' => $filename,
            ]);
        }

        if ($this->eduStatus = 'educating') {
            $eduStatus = 1;
        } else {
            $eduStatus = 0;
        }

        $guardian = Guardian::create([
            'user_id' => $base->id,
            'edu_status' => $eduStatus,
            'edu_level' => $this->eduLevel,
            'edu_site' => $this->eduSite,
            'work_title' => $this->workTitle,
            'work_site' => $this->workSite,
            'edu_major' => $this->eduMajor,
            'religion' => $this->religion,
        ]);

        if ($data['email'] !== null) {
            // $expiresAt = now()->addDay();
            // $base->sendWelcomeNotification($expiresAt);
            $emailData = [
                'email' => $data['email'],
                'guardianName' => $base->name,
                'guardianEmail' => $base->email,
                'guardianMobile' => $base->mobile_number,
                'guardianPassword' => 'inpirasi2024'
            ];

            SendRegisterGuardian::dispatch($emailData);
        }

        session()->flash('success', 'Registrasi wali murid baru berhasil.');
        return $this->redirect(route('guardian.index'), navigate: true);
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
            'whatsapp' => ['required', 'numeric', 'unique:users,mobile_number'],
        ], [
            'whatsapp.required' => 'Nomor Whatsapp murid tidak boleh kosong',
            'whatsapp.unique' => 'Nomor telepon sudah digunakan, silakan gunakan nomor telepon lain',
        ]);
    }

    public function updatedName()
    {
        $this->validate(['name' => ['required', 'string', 'max:255']], [
            'name.required' => 'Nama murid tidak boleh kosong',
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
        return view('livewire.guardian.register');
    }
}
