<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        $title = 'Form Login Munja Fire';

        return view('login.index', compact('title'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $username = strtolower($request->username);
        $password = $request->password;

        $user = User::where('username', $username)->first();
        if (!$user) {
            return back()->with('error', 'Username not found. Please check your username.');
        }
        $check_password = Hash::check($password, $user->password);
        if (!$check_password) {
            return back()->with('error', 'Invalid password. Please try again.');
        }
        Auth::login($user);
        return redirect('/dashboard')->with('success', 'Login Successfully');
    }
}
