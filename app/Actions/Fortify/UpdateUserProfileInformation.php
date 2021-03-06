<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'min:3'],
            'username' => ['required', 'string', 'min:3'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ])->validateWithBag('updateProfileInformation');

        $user->forceFill([
            'name' => $input['name'],
            'username' => $input['username'],
            'email' => $input['email'],
            'mobile' => $input['mobile'],
            'address' => $input['address'],
        ])->save();

        $notification = array(
            'messege' => 'Profile Updated Successfully ',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
