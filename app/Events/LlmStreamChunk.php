<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Support\Facades\Log;

class LlmStreamChunk implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets;

    public $chatId;
    public $chunk;
    public $done;

    public function __construct($chatId, $chunk, $done)
    {
        $this->chatId = $chatId;
        $this->chunk = $chunk;
        $this->done = $done;
        Log::info('Preparing LlmStreamChunk', ['chatId' => $chatId, 'chunk' => $chunk, 'done' => $done]);
    }

    public function broadcastOn()
    {
        Log::info('Broadcasting on', ['channel' => 'chat.' . $this->chatId]);
        return new Channel('chat.' . $this->chatId);
    }

    public function broadcastAs()
    {
        Log::info('Broadcasting as', ['event' => 'LlmStreamChunk']);
        return 'LlmStreamChunk';
    }
}