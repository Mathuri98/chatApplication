<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $senderType;


    /**
     * Create a new event instance.
     */
    public function __construct($message, $senderType = 'user')
    {
        $this->message = $message;
        $this->senderType = $senderType;
    }

    /**
     * The channel the event should broadcast on.
     */
    public function broadcastOn(): Channel
    {
        return new Channel('chat');
    }

    /**
     * The event name the frontend listens for.
     */
    public function broadcastAs()
    {
        return 'MessageSent';
    }
}
