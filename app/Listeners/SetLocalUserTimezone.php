<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Auth\Events\Registered;

class SetLocalUserTimezone
{
    /**
     * Handle the event.
     *
     * @param Registered $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = $event->user;
        if ($user->timezone === null) {
            $geoIp = geoip()->getLocation();
            $user->timezone = $geoIp['timezone'];
            $user->save();
        }
    }
}
