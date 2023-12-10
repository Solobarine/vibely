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
            'first_name' => ['required', 'string', 'min:2', 'max:255'],
            'middle_name' => ['string', 'min:2', 'max:255'],
			'last_name' => ['required', 'string', 'min:2', 'max:255'],
			'country' => ['required', 'string', 'max:255', 'min:3'], 
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'first_name' => $input['first_name'],
			'middle_name' => $input['middle_name'] ? $input['middle_name'] : '',
            'last_name' => $input['last_name'],
            'country' => $input['country'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
