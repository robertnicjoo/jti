<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\MyEvent;
use Log;

class MyEventListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(MyEvent $event)
    {
        Log::info("Listener:: $event->phone was Created.");
        return $event->phone;
    }
}
