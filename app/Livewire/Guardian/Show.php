<?php

namespace App\Livewire\Guardian;

use App\Models\Guardian;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Jenssegers\Date\Date;


use Livewire\Component;

class Show extends Component
{
    public $status, $data, $slug, $acronym, $photoUrl, $eduLevel, $acronymPlus, $name, $address, $birthday, $nextAnniversary, $whatsapp, $photo, $childrens, $religion, $guardianWhatsapp, $registeredAt, $lastLoginAt, $lastActiveAt, $eduStatus, $eduSite, $workSite, $workTitle;

    public function mount($slug)
    {
        $data = Guardian::with('userData', 'theChildren')
        ->whereHas('userData', function($q) use ($slug) {
            $q->search('slug', $slug);
        })
        ->firstOrFail();
        // dd($data);
        $this->data = $data;
        $this->childrens = $data->theChildren;
        $this->religion = $data->religion;
        $this->slug = $data->userData->slug;
        $this->name = $data->userData->name;
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
        $this->status = $data->userData->exist_status;

        // $words = preg_split("/\s+/", $this->name);
        // $this->acronym = '';
        // $this->acronymPlus = '';
        // foreach ($words as $w) {
        //     $this->acronym .= mb_substr($w, 0, 1);
        //     $this->acronymPlus .= mb_substr($w, 0, 1) . '+';
        // }

        if ($this->photo == '') {
            $this->photoUrl = 'https://ui-avatars.com/api/?size=512&length=2&name='. $this->data->userData->theAcronym() .'&color=7F9CF5&background=EBF4FF';
        } else {
            $this->photoUrl = asset($this->photo);
        }
    }

    public function render()
    {
        return view('livewire.guardian.show');
    }
}
