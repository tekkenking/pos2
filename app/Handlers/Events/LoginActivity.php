<?php

namespace App\Handlers\Events;

use App\Events\UserLoggedIn;
use Activity;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoginActivity
{
    public $user;
    /**
     * Create the event handler.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserLogin  $event
     * @return void
     */
    public function handle(UserLoggedIn $event)
    {
        //$this->user = $event->user;

        $this->doLoggedInTime();
    }

    public function doLoggedInTime()
    {
        Activity::make('loggedin');
    }
}
