<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeetingEvaluation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function theEval()
    {
        return $this->belongsTo(Evaluation::class, 'eval_id', 'id');
    }

    public function theCourse()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
}
