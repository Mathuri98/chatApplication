<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('chats.index',);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
      



        return view('chats.create', );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //


       $validated= $request->validate([
        'title'=> ['required']
       ]);
       
       
        $chat= Auth::user()->chats()->create($validated); 

        return redirect( )->route('chats.show', ['chat' => $chat->id]); 

    }

       
    /**
     * Display the specified resource.
     */
    public function show(Chat $chat)
    {
        //
        return view('chats.show', [
            'chat'=> $chat, 
        ] );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
