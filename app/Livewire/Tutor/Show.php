<?php

namespace App\Livewire\Tutor;

use App\Models\Student;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;


use Livewire\Component;

class Show extends Component
{
    public $email, $tutor, $whatsapp, $birthday, $name, $photo, $city, $address, $province, $eduStatus = 'educating', $eduLevel, $workTitle = 'unemployed', $workSite, $eduSite, $bankNumber, $bankName, $bankAdditionalInfo, $eduMajor, $religion, $hobbies, $passion, $motto, $teachingExp, $leadershipExp, $competitionExp, $acronym, $acronymPlus, $status, $registeredAt, $lastLoginAt, $lastActiveAt, $photoUrl, $nextAnniversary, $slug;

    public function mount($slug)
    {
        $data = Tutor::with('userData', 'theSkill')
            ->whereHas('userData', function ($q) use ($slug) {
                $q->where('slug', $slug);
            })->firstOrFail();
        // dd($data);
        $this->tutor = $data;
        $this->name = $data->userData->name;
        $this->email = $data->userData->email;
        $this->address = $data->userData->address;
        $this->eduLevel = $data->edu_level;
        $this->eduStatus = $data->edu_status;
        $this->eduSite = $data->edu_site;
        $this->workSite = $data->work_site;
        $this->workTitle = $data->work_title;
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

        // $words = preg_split("/\s+/", $this->name);
        // $this->acronym = '';
        // $this->acronymPlus = '';
        // foreach ($words as $w) {
        //     $this->acronym .= mb_substr($w, 0, 1);
        //     $this->acronymPlus .= mb_substr($w, 0, 1) . '+';
        // }

        if ($this->photo == '') {
            $this->photoUrl = 'https://ui-avatars.com/api/?size=512&length=2&name=' . $this->tutor->userData->theAcronym() . '&color=7F9CF5&background=EBF4FF';
        } else {
            $this->photoUrl = asset($this->photo);
        }

        // dd($this);
    }

    public function render()
    {
        return view('livewire.tutor.show');
    }
}
