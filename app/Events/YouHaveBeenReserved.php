<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class YouHaveBeenReserved extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $data ;
    public $user ;

    public function __construct($user,$data)
    {
        $this->user = $user ;
        $this->data = $data ;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [ 'user' . $this->user->id ];
    }
}
