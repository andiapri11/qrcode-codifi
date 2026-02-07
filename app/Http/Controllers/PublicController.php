<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function download()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        
        return view('public.download', [
            'settings' => $settings
        ]);
    }
}
