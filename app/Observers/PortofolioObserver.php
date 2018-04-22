<?php

namespace App\Observers;

use App\Http\Traits\TraitObserver;
use App\Models\Portofolio;

class PortofolioObserver
{
    use TraitObserver;

    /**
     * Listen to the Portofolio creating event.
     *
     * @param \App\Models\Portofolio $portofolio
     *
     * @return void
     */
    public function creating(Portofolio $portofolio)
    {
        //
    }

    /**
     * Listen to the Portofolio created event.
     *
     * @param \App\Models\Portofolio $portofolio
     *
     * @return void
     */
    public function created(Portofolio $portofolio)
    {
        $this->flushCacheTag(['search']);
    }

    /**
     * Listen to the Portofolio updating event.
     *
     * @param \App\Models\Portofolio $portofolio
     *
     * @return void
     */
    public function updating(Portofolio $portofolio)
    {
        //
    }

    /**
     * Listen to the Portofolio updated event.
     *
     * @param \App\Models\Portofolio $portofolio
     *
     * @return void
     */
    public function updated(Portofolio $portofolio)
    {
        $this->flushCacheTag(['search']);
    }

    /**
     * Listen to the Portofolio deleting event.
     *
     * @param \App\Models\Portofolio $portofolio
     *
     * @return void
     */
    public function deleting(Portofolio $portofolio)
    {
        //
    }

    /**
     * Listen to the Portofolio deleted event.
     *
     * @param \App\Models\Portofolio $portofolio
     *
     * @return void
     */
    public function deleted(Portofolio $portofolio)
    {
        $this->flushCacheTag(['search']);
    }
}
