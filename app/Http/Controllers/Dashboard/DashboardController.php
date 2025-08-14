<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\BirthCertificate;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        if (auth()->user()->isSuperAdmin()) {
            // Les utilisateurs
            $userCount = User::count();
            // les demandes
            $countBirthCertificate = BirthCertificate::count();
            return view(
                'dashboard.super',
                compact(
                    'userCount',
                    'countBirthCertificate'
                )
            );
        } else if (auth()->user()->isAdmin()) {
            // on retourne les extrait si la localité de l'admin est celle de la demande
            $birthCertificates = BirthCertificate::where('city', $user->residence)->get();
            $countBirthCertificate = count($birthCertificates);
            return view(
                'dashboard.admin',
                compact(
                    'countBirthCertificate'
                )
            );
        }


    }
}