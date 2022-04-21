<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $from_id;
    public $to_id;
    public $body;
    public $item;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($from_id, $to_id, $item, $body)
    {
        $this->from_id = $from_id;
        $this->to_id = $to_id;
        $this->item = $item;
        $this->body = $body;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('chat-'.$this->item.'-'.$this->from_id.'-'.$this->to_id);
    }

    public function broadcastAs(){
        return 'messageEvent';
    }
}
