<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamLink extends Model
{
    protected $fillable = [
        'school_id',
        'title',
        'exam_url',
        'secure_token',
        'is_active',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
