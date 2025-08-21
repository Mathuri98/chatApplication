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

    
    public $chunk;
    public $unique_id;

    public function __construct( $chunk, $unique_id=null)
    {
       
        $this->chunk = $chunk;
        $this->unique_id = $unique_id ?? uniqid(); // Generate a unique ID if not provided
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
