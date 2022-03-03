<?php

namespace App\Listeners;

use App\Models\Setting;
use App\Events\UserCreated;

class AddDummySettings
{
    /**
     * Create the event listener.
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
     * @param \App\Events\UserCreated $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        Setting::query()->create([
            'user_id' => $event->user->id,
        ]);
    }
}
