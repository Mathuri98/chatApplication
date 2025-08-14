<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('auth.login'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate
        //attempt to log in user 
        //regenerate session token 
        //return redirect 
        $attributes= $request->validate([
            'email' =>  ['required', 'email'], 
            'password'=> ['required']
        ]); 

       if(! ( Auth::attempt($attributes))){

            throw ValidationException::withMessages([
                'email'  => 'Sorry those credentials do not match. Please try again. '
            ]);

        }
         $request->session()->regenerate();

         return redirect('/')->with('success', 'You are Logged In'); 

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //

        Auth::logout();
        return redirect('/login')->with('success', 'Logged out'); 

    }
}
