<?php

namespace App\Livewire\Guardian;

use App\Models\Guardian;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $search;


    public function render()
    {
        // sleep(1);
        $key = $this->search;
        $guardians = Guardian::with(['userData', 'theChildren.userData'])
        // ->join('users as u','u.id','=','guardians.user_id')
        // ->select('u.*','guardians.id as guardian_id')
        // ->join('students as s','s.guardian_id','=','guardians.id')
        ->whereHas('userData', function($q) use ($key) {
            $q->search('name', $key)
            ->orSearch('mobile_number', $key)
            ->orSearch('email', $key)
            ->orderBy('name', 'asc');
        })
        ->paginate(50);
        // dd($guardians);
        return view('livewire.guardian.index', [
            'guardians' => $guardians
        ]);
    }
}
