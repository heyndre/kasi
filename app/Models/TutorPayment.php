<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TutorPayment extends Model
{
    use HasFactory;

    protected $guarded = [], $table = 'tutor_payment_sharing';

    public function theTutor()
    {
        return $this->belongsTo(Tutor::class, 'tutor_id', 'id');
    }

    public function theBill()
    {
        return $this->belongsTo(Billing::class, 'billing_id', 'id');
    }
}
