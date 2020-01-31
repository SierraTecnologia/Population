<?php

namespace Population\Traits;

use Log;

trait AsFofocavel
{
    
    /**
     * One To Many (Polymorphic) - Feature FA
     *
     * @return void
     */

    public function infos()
    {
        return $this->morphMany('Population\Models\Market\Abouts\Info', 'infoable');
    }

    public function fatos()
    {
        return $this->morphMany('Population\Models\Identity\Subjetivos\Fato', 'fatoable');
    }

    /**
     * Ajudantes que chamam outras funcoes
     */
    public function setDiario($date, $text)
    {
        $this->fatos()->create([
            'date' => $date,
            'text' => $text
        ]);
    }
    /**
     * Construtores
     */
    public function diario($date, $comment)
    {
        // @todo 
        return true;
    }
    

    /**
     * DataInfo do Usuario - @todo Refazer
     *
     * @param array $data
     * @return void
     */
    public function addDataInfo($data)
    {
        // @todo Refazer
        return $this->infos()->create([
            'text' => implode(';', $data)
        ]);
    }

    /**
     * Events
     */
    public static function bootAsFofocavel()                                                                                                                                                             
    {

        // static::deleting(function (self $user) {
        //     optional($user->photos)->each(function (Photo $photo) {
        //         $photo->delete();
        //     });
        // });
    }
    

}
