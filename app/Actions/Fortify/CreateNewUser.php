<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
            'contact_2' => ['nullable', 'string', 'max:255'],
            // 'username' => ['nullable', 'string', 'max:255', 'unique:users'],
            'username' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'residence' => ['required', 'string', 'max:255'],
            'neighborhood' =>['required', 'string', 'max:255'],
            'municipal_office_city' => ['required', 'string', 'max:255'],
            'municipal_office' => ['required', 'string', 'max:255'],
        ])->validate();

        return User::create([
            'name' => $input['name'] + ' ' + $input['surname'],
            'contact' => $input['contact1'],
            'contact_2' => $input['contact2'] ?? null,
            'username' => $input['username'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role' => 'admin',
            'residence' => $input['residence'] ?? 'Bouake',
            'neighborhood' => $input['neighborhood'] ?? 'Dar-es-Salam',
            'municipal_office_city' => $input['city'] ?? 'Bouake',
            'municipal_office' => $input['municipalOffice'] ?? 'Bouake',
            'status' => true, // Default status set to true

        ]);
    }
}
