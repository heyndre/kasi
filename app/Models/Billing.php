<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'bill_date' => 'datetime',
        'due_date' => 'datetime',

    ];

    public function theStudent()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function theClass()
    {
        return $this->hasMany(Course::class, 'class_id', 'id');
    }
}
