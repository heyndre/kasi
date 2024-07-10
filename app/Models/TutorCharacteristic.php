<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorCharacteristic extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function theTutor() {
        return $this->belongsTo(Tutor::class, 'tutor_id');
    }
}
