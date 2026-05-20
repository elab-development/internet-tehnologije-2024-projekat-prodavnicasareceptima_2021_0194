<?php

namespace App\Observers;

use App\Models\Korpa;

class KorpaObserver
{
    /**
     * Handle the Korpa "created" event.
     */
    public function created(Korpa $korpa): void
    {
        $korpa->ukupnaCena = 0;
        $korpa->saveQuietly();
    }

    /**
     * Handle the Korpa "updated" event.
     */
    public function updated(Korpa $korpa): void
    {
        //
    }

    /**
     * Handle the Korpa "deleted" event.
     */
    public function deleted(Korpa $korpa): void
    {
        //
    }

    /**
     * Handle the Korpa "restored" event.
     */
    public function restored(Korpa $korpa): void
    {
        //
    }

    /**
     * Handle the Korpa "force deleted" event.
     */
    public function forceDeleted(Korpa $korpa): void
    {
        //
    }
}
