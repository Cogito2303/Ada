<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class FortifyFailedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */

    // Mieux gérer les erreur
    public function handle(object $event): void
    {
        $user = $event->user;

    if ($user && ! $user->is_active) {
        Session::flash('inactive_error', 'Ce compte est inactif.');
        Log::info('⚠️ Utilisateur inactif détecté : ' . $event->user->email);

    }

    }
}
