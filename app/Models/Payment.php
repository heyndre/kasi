<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'pay_date' => 'datetime',
        'confirm_date' => 'datetime',
    ];

    public function theBill()
    {
        return $this->belongsTo(Billing::class, 'billing_id', 'id');
    }

    public function getPayMethodAttribute($value)
    {
        switch ($value) {
            case 'bank_transfer':
                return 'Transfer Bank';
            case 'package':
                return 'Paket Kelas';
            case 'other':
                return 'Metode Lain';
        }
    }
}
