<?php

namespace App\Livewire\Pages\Auth;

use Livewire\Component;

class LoginPageComponent extends Component
{
    public $credentials = [];

    protected $rules = [
        'credentials.email' => 'required|email',
        'credentials.password' => 'required',
    ];

    protected $messages = [
        'credentials.email.required' => 'email field is required',
        'credentials.email.email' => 'email must be a valid email address',
        'credentials.password.required' => 'password field is required',
    ];

    public function render()
    {
        return view('livewire.pages.auth.login-page-component');
    }

    public function login()
    {
        $this->validate();

        if (auth()->attempt($this->credentials)) {
            return redirect('/');
        }

        $this->addError('credentials.invalid', 'The provided credentials are incorrect.');
    }
}
