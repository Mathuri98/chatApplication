<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Text;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TextController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //to create a new text. a chat belongs to a user and a chat can have many texts.
        // dd('storing for {{$request->chat_id}}'); 
        $user= Auth::user();


        $sentence= $request['sentence'];
       
//passed as hidden input from chats/create 
        $chat= Chat::findOrFail($request['chat_id']); 

        $chat->texts()->create([
            'sentence'=> $sentence
        ]); 
      

        return redirect( )->route('chats.show', ['chat' => $chat->id]); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
