<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('user', 'password'))) {
            return redirect()->route('welcome')->with('message', 'si');
        }

        return redirect()->route('welcome')->with('message', 'no');
    }
}
