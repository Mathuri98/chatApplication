<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\LlmService;
use App\Models\Chat;
use App\Models\Text;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TextController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = Auth::user();

        //the actual string here 
        $sentence = $request['sentence'];

        //passed as hidden input from chats/create 
        $chat = Chat::findOrFail($request['chat_id']);

        $text = $chat->texts()->create([
            'sentence' => $sentence
        ]);

        broadcast(new MessageSent($text->sentence, 'user', $chat->id))->toOthers();



        $allTexts = $chat->texts; //get all texts for this chat for the llm to reason the context. otherwise it only responds to one single prompt at a time and cant recall the previous conversation.
        $llmservice = new LlmService();
        // $llmController = new LlmController();

        $llmResponse = $llmservice->generateText( $allTexts->pluck('sentence')->toArray()); //get the response from the llm. This is the full response. 

        //create a new entry in the texts table for the LLM response
        $llmText = Text::create([
            'sentence' => $llmResponse,
            'chat_id' => $chat->id,
            'senderType' => 'llm', // indicating this text is from the LLM
        ]);


        // broadcast(new MessageSent($llmText->sentence, 'llm', $chat->id))->toOthers();

        return response()->json([

            'status' => 'ok'
        ]);
    }
}
