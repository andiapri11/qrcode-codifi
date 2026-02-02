<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'school_id',
        'reference',
        'type',
        'amount',
        'status',
        'snap_token',
        'paid_at',
        'midtrans_payload',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'midtrans_payload' => 'json',
        'amount' => 'decimal:2',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
