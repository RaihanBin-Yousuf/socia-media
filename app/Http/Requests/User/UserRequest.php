<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'address' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'min:3'],
            'profile_img' => ['image', 'max:2048'],
            'email'=>'required|string|email|unique:users,email,' . auth()->id(),
            // 'mobile' => 'required|regex:/(01)[0-9]{9}/',
            // 'password' =>[
            //     'required','string',
            //     Password::min(8)->letters()->numbers()->mixedCase()->symbols()
            // ],
        ];
    }
}
