<?php

namespace App\Observers;

use App\Models\Phone;
use App\Events\MyEvent;
use Log;

class MyEventObserve
{
    /**
     * Handle the Phone "created" event.
     *
     * @param  \App\Models\Phone  $phone
     * @return void
     */
    public function created(Phone $phone)
    {
        Log::info("Observe:: $phone");
        event(new MyEvent($phone));
    }

    /**
     * Handle the Phone "updated" event.
     *
     * @param  \App\Models\Phone  $phone
     * @return void
     */
    public function updated(Phone $phone)
    {
        //
    }

    /**
     * Handle the Phone "deleted" event.
     *
     * @param  \App\Models\Phone  $phone
     * @return void
     */
    public function deleted(Phone $phone)
    {
        //
    }

    /**
     * Handle the Phone "restored" event.
     *
     * @param  \App\Models\Phone  $phone
     * @return void
     */
    public function restored(Phone $phone)
    {
        //
    }

    /**
     * Handle the Phone "force deleted" event.
     *
     * @param  \App\Models\Phone  $phone
     * @return void
     */
    public function forceDeleted(Phone $phone)
    {
        //
    }
}
