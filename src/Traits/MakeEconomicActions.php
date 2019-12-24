<?php

namespace Informate\Traits;

use Log;

trait MakeEconomicActions
{

    /**
     * Financeiro
     */
    public function banks()
    {
        return $this->morphToMany('Population\Models\Market\Actors\Bank', 'bankable');
    }
    public function rendas()
    {
        return $this->morphMany('Casa\Models\Economic\Renda', 'rendable');
    }
    public function gastos()
    {
        return $this->morphMany('Casa\Models\Economic\Gasto', 'gastoable');
    }

    /**
     * Events
     */
    public static function bootMakeEconomicActions()                                                                                                                                                             
    {

        // static::deleting(function (self $user) {
        //     optional($user->photos)->each(function (Photo $photo) {
        //         $photo->delete();
        //     });
        // });
    }
    

}
