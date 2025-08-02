<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->isSuperAdmin(), 403);
        return view('settings.index');
    }
}
