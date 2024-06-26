<?php

namespace App\Livewire\Tutor;

use App\Jobs\SendRegisterTutor;
use App\Models\CourseBase;
use App\Models\CoursePivot;
use App\Models\Student;
use App\Models\Tutor;
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

    public $email, $whatsapp, $nickname, $birthday, $name, $skills, $avatar, $city, $address, $province, $eduStatus = 'educating', $eduLevel, $workTitle = 'unemployed', $workSite, $eduSite, $bankAccount, $bankName, $bankAdditionalInfo, $eduMajor, $religion, $hobbies, $passion, $motto, $teachingExp, $leadershipExp, $competitionExp;

    public function register()
    {
        // dd($this);
        $data = $this->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'whatsapp' => ['required', 'numeric', 'unique:users,mobile_number'],
            'name' => ['required', 'string', 'max:255'],
            'nickname' => ['required', 'string', 'max:255', 'unique:users,nickname'],
            'address' => ['required', 'string', 'max:512'],
            'avatar' => ['image', 'max:5120', 'nullable'],

        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah digunakan, silakan gunakan alamat email lain',
            'email.unique' => 'Username sudah digunakan, silakan gunakan username lain',
            'whatsapp.required' => 'Nomor Whatsapp murid tidak boleh kosong',
            'whatsapp.unique' => 'Nomor telepon sudah digunakan, silakan gunakan nomor telepon lain',
            'whatsapp.numeric' => 'Nomor telepon tidak valid',
            'address.required' => 'Alamat murid tidak boleh kosong',
            'name.required' => 'Nama murid tidak boleh kosong',
        ]);

        $base = User::create([
            'email' => $data['email'],
            'name' => $data['name'],
            'nickname' => $data['nickname'],
            // 'password' => Hash::make('BelajarDuluMenginspirasiKemudian'),
            'password' => Hash::make('2024menginspirasi'),
            'mobile_number' => $data['whatsapp'],
            'birthday' => $this->birthday,
            'address' => $this->address,
            'role' => 'TUTOR',
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

        $tutor = Tutor::create([
            'user_id' => $base->id,
            'edu_status' => $eduStatus,
            'edu_level' => $this->eduLevel,
            'edu_site' => $this->eduSite,
            'work_title' => $this->workTitle,
            'work_site' => $this->workSite,
            'bank_number' => $this->bankAccount,
            'bank_name' => $this->bankName,
            'bank_additional_info' => $this->bankAdditionalInfo,
            'edu_major' => $this->eduMajor,
            'religion' => $this->religion,
            'hobbies' => $this->hobbies,
            'passion' => $this->passion,
            'motto' => $this->motto,
            'teaching_experience' => $this->teachingExp,
            'leadership_experience' => $this->leadershipExp,
            'competition_experience' => $this->competitionExp,
        ]);

        foreach ($this->skills as $item) {
            CoursePivot::create([
                'tutor_id' => $tutor->id,
                'skill_id' => $item,
            ]);
        }

        if ($data['email'] !== null) {
            // $expiresAt = now()->addDay();
            // $base->sendWelcomeNotification($expiresAt);
            $emailData = [
                'email' => $data['email'],
                'tutorName' => $base->name,
                'tutorNickname' => $base->nickname,
                'tutorEmail' => $base->email,
                'tutorMobile' => $base->mobile_number,
                'tutorPassword' => '2024menginspirasi'
            ];

            SendRegisterTutor::dispatch($emailData);
        }

        session()->flash('success', 'Registrasi tutor baru berhasil.');
        return $this->redirect(route('tutor.active'), navigate: true);
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

    public function updatedNickname()
    {
        $this->validate([
            'nickname' => ['required', 'string', 'max:255', 'unique:users,nickname'],
        ], [
            'nickname.required' => 'Nickname tidak boleh kosong',
            'emanicknameil.unique' => 'Nickname sudah digunakan, silakan gunakan nickname lain',
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
        $skillBase = CourseBase::all();
        return view('livewire.tutor.register', ['skillBase' => $skillBase]);
    }
}
