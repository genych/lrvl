<?php

namespace App\Http\Controllers;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $ok = Auth::attempt($request->post(), true);
        if ($ok) {
            $request->session()->regenerate();
            return redirect('/');
        }

        throw new AuthenticationException();
    }

    public function logout()
    {
        Auth::logout();
        Auth::getSession()->flush();
        return redirect()->back();
    }
}
