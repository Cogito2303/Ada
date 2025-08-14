<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::redirectUserForTwoFactorAuthenticationUsing(RedirectIfTwoFactorAuthenticatable::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        // Connecté ou pas si l'utilisateur est activé ou desactivé

        Fortify::authenticateUsing(function ($request) {
        $user = User::where('email', $request->email)->first();
        // On verifie si l'utilisateur existe et si son compte est actif et son mdp est corrrect
          if ($user && Hash::check($request->password, $user->password)) {
            // On verifier si le compte de l'utilisateur est actif
                if (!$user->status === true) {
                    session()->flash('inactive_error', "Votre compte est suspendu. Veuillez contacter l'administrateur pour une réactivation.");
                    info("🚫 Compte inactif pour {$user->email}");
                    return null;
                }
                // Connecter l'utilisateur
                    return $user;
            }
            // Identifiants invalides
            session()->flash('inactive_error', "Echec connexion identfiants incorrects");
            return null;


    });

    }
}
