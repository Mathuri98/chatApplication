<?php

namespace App\Http\Controllers;

use App\LlmService;
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

//the actual string here 
        $sentence= $request['sentence'];

        
       
//passed as hidden input from chats/create 
        $chat= Chat::findOrFail($request['chat_id']); 

        $chat->texts()->create([
            'sentence'=> $sentence
        ]); 


        $allTexts= $chat->texts; //get all texts for this chat for the llm to reason the context. otherwise it only responds to one single prompt at a time and cant recall the previous conversation.
        $llmservice= new LlmService(); 
        $llmController= new LlmController();
        //  dd("\n", $allTexts->pluck('sentence')->toArray()); //get all sentences from the texts in this chat
        $llmResponse = $llmController->ask($llmservice, $allTexts->pluck('sentence')->toArray()); //get the response from the llm

        //create a new entry in the texts table for the LLM response
        Text::create([
            'sentence' => $llmResponse,
            'chat_id' => $chat->id,
            'senderType' => 'llm', // indicating this text is from the LLM
        ]);
      
        // dd($llmResponse); //for debugging purposes, remove later. we only need to transfer the chat id 
        // return redirect( )->route('chats.show', ['chat' => $chat->id]); 

        return response()->json([
            
        
            'llm_response' => $llmResponse,
            'chat_id' => $chat->id,
        ]);


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
