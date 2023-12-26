<?php

namespace App\Livewire\Admin\KBM;

use App\Models\Tutor;
use App\Models\User;
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

    public $email, $whatsapp, $birthday, $name, $photo, $city, $address, $province, $eduStatus = 'educating', $eduLevel, $workTitle = 'unemployed', $workSite, $eduSite, $bankNumber, $bankName, $bankAdditionalInfo, $eduMajor, $religion, $hobbies, $passion, $motto, $teachingExp, $leadershipExp, $competitionExp, $acronym, $acronymPlus, $status, $registeredAt, $lastLoginAt, $lastActiveAt, $photoUrl, $nextAnniversary, $slug, $user;

    protected $rules = [
        'name' => ['required', 'string'],
        'mobile_number' => ['required', 'numeric'],
        'address' => ['required', 'string'],
        'email' => ['required', 'string'],
    ];

    public function mount($slug)
    {
        $data = Tutor::with('userData')
            ->whereHas('userData', function ($q) use ($slug) {
                $q->where('slug', $slug);
            })->firstOrFail();
        $this->user = $data;
        $this->name = $data->userData->name;
        $this->email = $data->userData->email;
        $this->address = $data->userData->address;
        $this->eduLevel = $data->edu_level;
        $this->eduStatus = $data->edu_status;
        $this->eduSite = $data->edu_site;
        $this->workSite = $data->work_site;
        $this->workTitle = $data->getRawOriginal('work_title');
        $this->whatsapp = $data->userData->mobile_number;
        $this->photo = $data->userData->profile_photo_path;
        $this->registeredAt = $data->userData->created_at;
        $this->lastLoginAt = $data->userData->last_login_at;
        $this->lastActiveAt = $data->userData->last_active_at;
        $this->birthday = $data->userData->birthday;
        $this->nextAnniversary = $data->userData->nextAnniversary;
        $this->eduMajor = $data->edu_major;
        $this->bankName = $data->bank_name;
        $this->bankNumber = $data->bank_number;
        $this->bankAdditionalInfo = $data->bank_additional_info;
        $this->hobbies = $data->hobbies;
        $this->passion = $data->passion;
        $this->motto = $data->motto;
        $this->religion = $data->religion;
        $this->teachingExp = $data->teaching_experience;
        $this->leadershipExp = $data->leadership_experience;
        $this->competitionExp = $data->competition_experience;
        $this->status = $data->userData->exist_status;
        $this->slug = $data->userData->slug;
        // dd($this);
    }

    public function render()
    {
        // dd($this);
        return view('livewire.admin.k-b-m.edit');
    }

    public function updatedPhoto()
    {
        // dd($this->photo);
        $this->validate(['photo' => ['required', 'image', 'max:5120']], [
            'photo.image' => 'Silakan masukkan file gambar',
            'photo.max' => 'Ukuran file maksimal 5 MB',
        ]);
        if ($this->user->userData->profile_photo_path != null || $this->user->userData->profile_photo_path != '') {
            if (File::exists(public_path('profile-photos/' . $this->user->userData->profile_photo_path))) {
                // dd('yes');
                File::delete(public_path('profile-photos/' . $this->user->userData->profile_photo_path));
            }
        }
        Image::load($this->photo->getRealPath())->fit(Manipulations::FIT_FILL_MAX, 1080, 1080)->optimize()->save();
        $filename = $this->photo->store('/profile-photos', 'public');
        $this->user->userData->update([
            'profile_photo_path' => $filename,
        ]);
        // $this->emit('photoUpdated');
    }

    public function update()
    {
        $data = $this->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->user->userData->id],
            'whatsapp' => ['required', 'numeric', 'unique:users,mobile_number,' . $this->user->userData->id],
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:512'],
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah digunakan, silakan gunakan alamat email lain',
            'whatsapp.required' => 'Nomor Whatsapp tutor tidak boleh kosong',
            'whatsapp.unique' => 'Nomor telepon sudah digunakan, silakan gunakan nomor telepon lain',
            'whatsapp.numeric' => 'Nomor telepon tidak valid',
            'address.required' => 'Alamat tutor tidak boleh kosong',
            'name.required' => 'Nama tutor tidak boleh kosong',
        ]);

        // dd($this);
        $this->user->userData->update([
            'email' => $data['email'],
            'name' => $data['name'],
            // 'password' => Hash::make('BelajarDuluMenginspirasiKemudian'),
            // 'password' => Hash::make(Str::random(8)),
            'mobile_number' => $data['whatsapp'],
            'birthday' => $this->birthday,
            'address' => $this->address,
        ]);
        
        if ($this->eduStatus = 'educating') {
            $eduStatus = 1;
        } else {
            $eduStatus = 0;
        }

        $this->user->update([
            'edu_status' => $eduStatus,
            'edu_level' => $this->eduLevel,
            'edu_site' => $this->eduSite,
            'work_title' => $this->workTitle,
            'work_site' => $this->workSite,
            'bank_number' => $this->bankNumber,
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

        session()->flash('success', 'Pembaruan data tutor berhasil.');
        return $this->redirect(route('tutor.show', ['slug' => $this->user->userData->slug]), navigate: false);
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
