<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'min:3'],
            'username' => ['required', 'string', 'min:3'],
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique(User::class),
            ],
            'mobile' => ['required', 'string', 'min:11', 'max:11', 'unique:users'],
            'password' => $this->passwordRules(),
            // 'password' =>[
            //     'required','string','confirmed',
            //     Password::min(8)->letters()->numbers()->mixedCase()->symbols()
            // ],
            'profile_img' => ['image', 'max:2048'],
        ])->validate();

        if (empty($input['profile_img'])) {
            $input['profile_img'] = '';
        } else {
            $input['profile_img'] = uploadFile($input['profile_img'], '/profile');
        }
        // dd($input);

        return User::create([
            'name' => $input['name'],
            'username' => $input['username'],
            'mobile' => $input['mobile'],
            'email' => $input['email'],
            'address' => $input['address'],
            'profile_img' => $input['profile_img'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
