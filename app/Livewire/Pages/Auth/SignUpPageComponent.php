<?php

namespace App\Livewire\Pages\Auth;

use App\Models\User;
use Livewire\Component;

class SignUpPageComponent extends Component
{

    public $user = [];

    protected $rules = [
        'user.name' => 'required',
        'user.email' => 'required|email',
        'user.password' => 'required|confirmed',
    ];

    protected $messages = [
        'user.name.required' => 'name field is required',
        'user.email.required' => 'email field is required',
        'user.email.email' => 'email must be a valid email address',
        'user.password.required' => 'password field is required',
        'user.password.confirmed' => 'password does not match password confirmation',
    ];

    public function render()
    {
        return view('livewire.pages.auth.sign-up-page-component');
    }

    public function signup()
    {
        $this->validate();

        $this->user['password'] = bcrypt($this->user['password']);

        User::create($this->user);

        return redirect()->route('login');
    }
}
