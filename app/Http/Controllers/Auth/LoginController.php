<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();

            if(auth()->user()->role === 'admin' ){
                return redirect()->intended('/dashboard');
            }
            else{
                return redirect()->intended('/reservations');
            }
            
            
        }

        return back()->withErrors([
            'username' => 'هدا الاسم المستخدم أو كلمة المرور غير صحيحة.',
        ])->onlyInput('username');
    }
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }   
}
