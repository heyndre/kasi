<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Billing extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'bill_date' => 'datetime',
        'due_date' => 'datetime',
        'deadline' => 'datetime',
    ];

    public function theStudent()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function theStudentData()
    {
        return $this->hasOneThrough(User::class, Student::class, 'id', 'id', 'student_id', 'user_id');
    }

    public function theClass()
    {
        return $this->hasMany(Course::class, 'billing_id', 'id');
    }

    public function thePayment()
    {
        return $this->hasMany(Payment::class, 'billing_id', 'id');
    }

    public function theRefund()
    {
        return $this->hasMany(Expense::class, 'billing_id', 'id');
    }

    public function scopeBillBetween($query, array $dates)
    {
        $start = ($dates[0] instanceof Carbon) ? $dates[0] : Carbon::parse($dates[0]);
        $end   = ($dates[1] instanceof Carbon) ? $dates[1] : Carbon::parse($dates[1]);

        return $query->whereBetween('bill_date', [
            $start->startOfDay(),
            $end->endOfDay()
        ]);
    }
}
