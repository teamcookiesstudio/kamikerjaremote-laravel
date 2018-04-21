<?php

namespace App\Observers;

use App\User;
use App\Http\Traits\TraitObserver;

class UserObserver
{
    use TraitObserver;
    /**
     * Listen to the User creating event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function creating(User $user)
    {
        $this->generateUuid($user);
    }

    /**
     * Listen to the User created event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $this->flushCacheTag(['search']);
    }

    /**
     * Listen to the User updating event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updating(User $user)
    {
        //
    }

    /**
     * Listen to the User updated event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        $this->flushCacheTag(['search']);
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleting(User $user)
    {
        //
    }

    /**
     * Listen to the User deleted event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        $this->flushCacheTag(['search']);
    }
}