<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/homepage'); // Redirect to intended page or home
        }

        // Redirect back with error message on failure
        return redirect('/')->withErrors(['login' => 'Incorrect username or password']);
    }


    




    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'You have been logged out successfully.');
    }






    public function homepage(){

        if (Auth::check()) {
        return view('homepage');
        }
        else{
            return redirect('/')->with('error', 'Your session has expired. Please log in again.');
        }
    }
}
