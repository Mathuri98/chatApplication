<?php

namespace App;

use App\Events\MessageChunk;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class LlmService
{
    protected string $apiKey;
    protected string $baseUri;

    public function __construct()
    {
        $this->apiKey = config('services.groq.api_key');
        $this->baseUri = config('services.groq.base_uri');
    }

    public function generateText($prompts)
    {
        //the llm response is generated here. 
        $combinedPrompts = implode("\n", $prompts); // Combine the array of sentences into a single string
        $response = Http::withHeaders([ //response is already streamed here-> we already get the chunks here
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->withOptions(
            [
                'stream' => true, // Enable streaming if supported by the API
                'timeout' => 60, // Set a timeout for the request
            ]
        )
            ->post($this->baseUri . '/chat/completions', [
                'model' => 'llama3-70b-8192', // Example Groq model
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                    ['role' => 'user', 'content' => $combinedPrompts]  //the content field should be a string and not an array. 
                ],
                'max_tokens' => 256, // Adjust as needed
                'stream' => true, // Enable streaming if supported
            ]);

        //need to broadcast it from here itself 

        $fullContent = '';


        $unique_id= uniqid();

        foreach (explode("\n", $response->body()) as $line) {
            $line = trim($line);
            if (!$line || $line === 'data: [DONE]') continue;

            if (strpos($line, 'data: ') === 0) {
                $jsonStr = substr($line, 6);
                $data = json_decode($jsonStr, true);

                if (isset($data['choices'][0]['delta']['content'])) {
                    
                    $chunk = $data['choices'][0]['delta']['content'];
                    $fullContent .= $chunk;

                    // Broadcast each chunk to the UI 
                    broadcast(new MessageChunk($chunk, $unique_id));
                }
            }
        }

        // return full assembled content for textcontroller to save into the database. 
        return $fullContent;
    }
}
