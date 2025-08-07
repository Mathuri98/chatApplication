<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{


    public function export(Chat $chat)
    {
        // dd($chat->texts);
        
        $content = "Chat Title: {$chat->title}\n";
        foreach ($chat->texts as $text) {
            $content .= " - {$text->sentence}\n";
        }

        $callback = function () use ($content) {
            echo $content;
        };

        // Return a streamed response with a suggested file name:
        return response()->streamDownload(
            $callback,
            "chat-{$chat->id}.txt", // filename
            [
                'Content-Type' => 'text/plain',
            ]
        );







        // return redirect('/')->with('success', 'Chats exported successfully');
    }
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




        return view('chats.create',);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //


        $validated = $request->validate([
            'title' => ['required']
        ]);


        $chat = Auth::user()->chats()->create($validated);

        return redirect()->route('chats.show', ['chat' => $chat->id]);
    }


    /**
     * Display the specified resource.
     */
    public function show(Chat $chat)
    {
        //
        return view('chats.show', [
            'chat' => $chat,
        ]);
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
