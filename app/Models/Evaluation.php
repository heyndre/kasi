<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function theMeetingEval()
    {
        return $this->hasMany(MeetingEvaluation::class, 'eval_id', 'id');
    }

}
