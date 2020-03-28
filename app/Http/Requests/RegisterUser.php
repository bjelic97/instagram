<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUser extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function persist()
    {
        return User::create(
            [
                'name' => $this->input('name'),
                'role_id' => 2,
                'email' => $this->input('email'),
                'username' => $this->input('username'),
                'password' => md5($this->input('password'))
            ]
        );


        //  auth()->login($user);


        // Mail::to($user)->send(new Welcome($user));
    }
}
