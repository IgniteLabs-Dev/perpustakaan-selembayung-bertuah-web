<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Cookie;

class LoginComp extends Component
{
    public $email, $password;

    public function render()
    {

        return view('livewire.login-comp');
    }
    public function login()
    {
        $validator = Validator::make([
            'email' => $this->email,
            'password' => $this->password
        ], [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            session()->flash('error', 'Email and password are required.');
            return;
        }

        $credentials = ['email' => $this->email, 'password' => $this->password];

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                session()->flash('error', 'Email and password do not match.');
                return;
            }
        } catch (JWTException $e) {
            session()->flash('error', 'Please try again.');
            return;
        }

        $cookie = $this->getCookieWithToken($token);

        return redirect()->route('admin-manajemen-user')->withCookie($cookie);
    }

    protected function getCookieWithToken($token)
    {
        return cookie(
            'token',
            $token,
            5760,
            null,
            null,
            false,
            true,
            false,
            'Strict'
        );
    }
}
