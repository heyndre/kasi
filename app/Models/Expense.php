<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'spent_date' => 'datetime',
        'due_date' => 'datetime',
    ];

    public function theBill()
    {
        return $this->belongsTo(Billing::class, 'billing_id', 'id');
    }

    public function theTutor()
    {
        return $this->belongsTo(Tutor::class, 'tutor_id', 'id');
    }

    public function getPayMethodAttribute($value)
    {
        switch ($value) {
            case 'bank_transfer':
                return 'Transfer Bank';
            case 'gopay':
                return 'GoPay';
            case 'ovo':
                return 'OVO';
            case 'cash':
                return 'Tunai';
            case 'flip':
                return 'Layanan Flip';
            case 'other':
                return 'Metode Lain';
        }
    }
}
