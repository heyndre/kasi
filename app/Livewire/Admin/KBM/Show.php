<?php

namespace App\Livewire\Admin\KBM;

use App\Models\Billing;
use App\Models\Course;
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
    public $course, $billingStatus, $billingDate, $studentPayment, $tutorPayment;

    public function mount($id)
    {
        $this->course = Course::with('theTutor', 'theStudent', 'theCourse')
        ->where('id', $id)
        ->firstOrFail();
        $billing = Billing::where('class_id', $id)->first();
        
    }

    public function render()
    {
        return view('livewire.admin.kbm.show');
    }
}
