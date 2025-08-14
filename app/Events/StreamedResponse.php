<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Support\Facades\Log;

class StreamedResponse implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets;

    public $chatId;
    public $chunk;
   

    public function __construct($chatId, $chunk, )
    {
        $this->chatId = $chatId;
        $this->chunk = $chunk;
      
        Log::info('Preparing StreamedResponse', ['chatId' => $chatId, 'chunk' => $chunk, ]);
    }

    public function broadcastOn()
    {
        Log::info('Broadcasting on', ['channel' => 'chat.' . $this->chatId]);
        return new Channel('chat.' . $this->chatId);
    }

    public function broadcastAs()
    {
        Log::info('Broadcasting as', ['event' => 'StreamedResponse']);
        return 'StreamedResponse';
    }
}