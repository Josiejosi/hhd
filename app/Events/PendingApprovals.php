<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PendingApprovals extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $user;
    public $info;

    public function __construct( $user, $info )
    {
        $this->user = $user ;
        $this->info = $info ;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [ 'pending-orders-user-' . $this->user->id ];
    }
}
