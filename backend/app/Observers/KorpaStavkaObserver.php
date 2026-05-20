<?php

namespace App\Observers;

use App\Models\Korpa;
use App\Models\KorpaStavka;

class KorpaStavkaObserver
{
    /**
     * Handle the KorpaStavka "created" event.
     */
    public function created(KorpaStavka $korpaStavka): void
    {
        $this->recalc($korpaStavka->idKorpa);
    }

    /**
     * Handle the KorpaStavka "updated" event.
     */
    public function updated(KorpaStavka $korpaStavka): void
    {
        $this->recalc($korpaStavka->idKorpa);
    }

    /**
     * Handle the KorpaStavka "deleted" event.
     */
    public function deleted(KorpaStavka $korpaStavka): void
    {
        $this->recalc($korpaStavka->idKorpa);
    }

    /**
     * Handle the KorpaStavka "restored" event.
     */
    public function restored(KorpaStavka $korpaStavka): void
    {
        //
    }

    /**
     * Handle the KorpaStavka "force deleted" event.
     */
    public function forceDeleted(KorpaStavka $korpaStavka): void
    {
        //
    }

    private function recalc($idKorpa)
    {
        Korpa::query()->find($idKorpa)?->updateUkupnaCena();
    }
}
