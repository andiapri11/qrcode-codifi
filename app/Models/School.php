<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class School extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'slug',
        'domain_whitelist',
        'api_key',
        'is_active',
        'subscription_type',
        'subscription_expires_at',
        'max_links',
        'theme_color',
        'supervisor_password',
    ];

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
