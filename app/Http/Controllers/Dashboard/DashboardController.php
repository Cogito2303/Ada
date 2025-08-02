<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
 public function index()
{
    if (auth()->user()->isSuperAdmin()) {
        $userCount = User::count();
        return view('dashboard.super', compact('userCount'));
    }

    return view('dashboard.admin');
}
}