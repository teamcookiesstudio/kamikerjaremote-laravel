<?php

namespace App\Observers;

use App\Models\Profile;
use App\Http\Traits\TraitObserver;

class ProfileObserver
{
    use TraitObserver;
    /**
     * Listen to the Profile creating event.
     *
     * @param  \App\Models\Profile  $profile
     * @return void
     */
    public function creating(Profile $profile)
    {
        //
    }

    /**
     * Listen to the Profile created event.
     *
     * @param  \App\Models\Profile  $profile
     * @return void
     */
    public function created(Profile $profile)
    {
        $this->flushCacheTag(['search']);
    }

    /**
     * Listen to the Profile updating event.
     *
     * @param  \App\Models\Profile  $profile
     * @return void
     */
    public function updating(Profile $profile)
    {
        //
    }

    /**
     * Listen to the Profile updated event.
     *
     * @param  \App\Models\Profile  $profile
     * @return void
     */
    public function updated(Profile $profile)
    {
        $this->flushCacheTag(['search']);
    }

    /**
     * Listen to the Profile deleting event.
     *
     * @param  \App\Models\Profile  $profile
     * @return void
     */
    public function deleting(Profile $profile)
    {
        //
    }

    /**
     * Listen to the Profile deleted event.
     *
     * @param  \App\Models\Profile  $profile
     * @return void
     */
    public function deleted(Profile $profile)
    {
        $this->flushCacheTag(['search']);
    }
}