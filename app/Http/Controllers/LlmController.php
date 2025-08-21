<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LlmService;

class LlmController extends Controller
{
    //

    public function ask(LlmService $llm, array $instructions)
    {//instructions is the user prompts. 
        $response = $llm->generateText($instructions);
        // dd($response); // For debugging, remove in production
      
        $data = $response['choices'][0]['message']['content'] ?? 'No response';
        return $data; // plain text

        //this is the structure to retrieve the content fromthe response. content is what contains the generated text. 
    }
}
