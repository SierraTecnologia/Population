<?php

namespace Population\Traits;

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
    public function timings()
    {
        return $this->workers();
    }
    /**
     * Historico de QNt era o Saldo na epoca
     */
    public function saldo()
    {
        return $this->morphMany('Casa\Models\Historic\Saldo', 'saldoable');
    }


    /**
     * Worker e Tarefas
     */
    public function workers()
    {
        return $this->morphMany('Casa\Models\Economic\Worker', 'workerable');
    }
    /**
     * Get all of the points for the post.
     */
    public function points()
    {
        return $this->morphToMany('Gamer\Models\Point', 'pointable');
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
