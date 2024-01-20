<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorPayment extends Model
{
    use HasFactory;

    protected $guarded = [], $table = 'tutor_payment_sharing';
    protected $casts = [
        'pay_date' => 'datetime',
        'due_date' => 'datetime',
    ];

    public function theTutor()
    {
        return $this->belongsTo(Tutor::class, 'tutor_id', 'id');
    }

    public function theClass()
    {
        return $this->hasMany(Course::class, 'tutor_payment_id', 'id');
    }
}
