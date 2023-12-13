<?php

namespace App\Livewire\Tutor;

use App\Models\Tutor;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Inactive extends Component
{

    use WithPagination;

    public $search;

    public function render()
    {
        // sleep(1);
        return view('livewire.tutor.inactive', [
            'tutors' => Tutor::with('userData')
            ->join('users as u','u.id','=','tutors.user_id')
            ->search('tutors.id', $this->search)
            ->orSearch('u.name', $this->search)
            ->orSearch('u.mobile_number', $this->search)
            ->orSearch('u.email', $this->search)
            ->where('exist_status', 'Berhenti Sementara')
            ->orWhere('exist_status', 'Berhenti Permanen')
            ->paginate(50)
        ]);
    }
}
