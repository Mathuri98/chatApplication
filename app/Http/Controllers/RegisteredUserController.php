<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('auth.register'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validaton
        //create new user 
        //log in user 
        //return redirect 

        
        $validated= $request->validate([
            'name'=>['required'], 
            'email'=>['required', 'email', 'unique:users'], 
            'password'=>['required', 'confirmed', Password::min(6)], 
        ]); 


        $user= User::create($validated); 

        Auth::login($user);

        return redirect('/')->with('success', 'Account created successfully'); 
    }

   
}
