<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(AuthRegisterRequest $request)
    {
        $fields = $request->validated();

        $username = Str::slug($fields['full_name']) . '-' . Str::random(8) . now()->format('YmdHis');

        User::create([
            'username' => $username,
            'full_name' => $fields['full_name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        return $this->success('User registered successfully');
    }

    public function login(AuthLoginRequest $request)
    {
        $fields = $request->validated();

        if (! Auth::attempt($fields)) {
            return $this->fail('Invalid credentials');
        }

        $request->session()->regenerate();

        return $this->success('User logged in successfully');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();

        return $this->success('User logged out successfully');
    }
}
