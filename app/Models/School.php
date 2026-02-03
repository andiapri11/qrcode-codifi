<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class School extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'logo',
        'slug',
        'school_code',
        'domain_whitelist',
        'api_key',
        'is_active',
        'subscription_type',
        'subscription_expires_at',
        'max_links',
        'theme_color',
        'supervisor_password',
        'exit_password',
        'violation_password',
        'custom_background',
    ];

    protected static function booted()
    {
        static::creating(function ($school) {
            if (!$school->school_code) {
                do {
                    $code = strtoupper(\Illuminate\Support\Str::random(5));
                } while (static::where('school_code', $code)->exists());
                $school->school_code = $code;
            }
        });
    }

    protected $casts = [
        'subscription_expires_at' => 'datetime',
        'is_active' => 'boolean',
        'max_links' => 'integer',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function examLinks()
    {
        return $this->hasMany(ExamLink::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function isSubscriptionActive()
    {
        if ($this->subscription_type === 'lifetime') {
            return true;
        }

        if (!$this->subscription_expires_at) {
            return false;
        }

        return $this->subscription_expires_at->isFuture();
    }

    public function canCreateMoreLinks()
    {
        if (!$this->isSubscriptionActive()) {
            return false;
        }

        if ($this->subscription_type === 'lifetime') {
            return true;
        }

        return $this->examLinks()->count() < $this->max_links;
    }

    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            if (filter_var($this->logo, FILTER_VALIDATE_URL)) {
                return $this->logo;
            }
            
            return asset('storage/' . $this->logo);
        }
        
        return null;
    }

    public function getBackgroundUrlAttribute()
    {
        if ($this->custom_background) {
            return asset('storage/' . $this->custom_background);
        }
        return null;
    }

    public function getInitialsAttribute()
    {
        $words = explode(' ', $this->name);
        $initials = '';
        foreach ($words as $w) {
            $initials .= strtoupper($w[0]);
            if (strlen($initials) >= 2) break;
        }
        return $initials ?: 'SC';
    }
}
