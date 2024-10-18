<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Models\User;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(AuthRegisterRequest $request)
    {
        $fields = $request->validated();

        $username = Str::slug($fields['full_name']).'-'.Str::random(8).now()->format('YmdHis');

        User::create([
            'username' => $username,
            'full_name' => $fields['full_name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        return $this->success('User registered successfully');
    }
}
