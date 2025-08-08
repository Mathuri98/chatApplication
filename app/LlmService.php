<?php

namespace App;

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

    public function generateText($prompt)
    {

        $combinedPrompt= implode("\n", $prompt); // Combine the array of sentences into a single string
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
        ])->post($this->baseUri . '/chat/completions', [
            'model' => 'llama3-70b-8192', // Example Groq model
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful assistant.'],
                ['role' => 'user', 'content' => $combinedPrompt]  //the content field should be a string and not an array. 
            ],
            'max_tokens' => 256, // Adjust as needed
        ]);

        return $response->json();
    }
}
