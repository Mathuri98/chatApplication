<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageChunk implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chatId;
    public $textId;
    public $chunk;

    public function __construct($chatId, $textId, $chunk)
    {
        $this->chatId = $chatId;
        $this->textId = $textId;
        $this->chunk = $chunk;
    }

    public function broadcastOn()
    {
        return new Channel('chat'); // per-chat channel
    }

    public function broadcastAs()
    {
        return 'MessageChunk';
    }
}
