<?php

namespace App\Events;

use App\Libs\Repos\User as User;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserLoggedIn extends Event
{
    use SerializesModels;

    //public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->user = $user;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
