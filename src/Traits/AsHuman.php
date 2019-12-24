<?php

namespace Population\Traits;

use Log;

trait AsHuman
{
    use AsOrganization;

    /**
     * Construtores
     */
    public function diario($date, $comment)
    {
        // @todo 
        return true;
    }
    /**
     * One To Many (Polymorphic) - Feature FA
     *
     * @return void
     */
    public function pircings()
    {
        return $this->morphMany('Population\Models\Identity\Fisicos\Pircing', 'pircingable');
    }
    public function pintinhas()
    {
        return $this->morphMany('Population\Models\Identity\Fisicos\Pintinha', 'pintinhable');
    }
    public function tatuages()
    {
        return $this->morphMany('Population\Models\Identity\Fisicos\Tatuage', 'tatuageable');
    }
    
    /**
     * Projetos do Usuario - Refazer
     *
     * @param array $data
     * @return void
     */
    public function addProject($data)
    {
        // @todo Refazer
        return $this->infos()->create([
            'text' => implode(';', $data)
        ]);
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
     * Many To Many (Polymorphic)
     */
    public function productions()
    {
        return $this->morphToMany('Population\Models\Components\Productions\Production', 'productionable');
    }
    public function personagens()
    {
        return $this->morphToMany('Population\Models\Market\Actors\Personagem', 'personagenable');
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
     * Events
     */
    public static function bootAsHuman()                                                                                                                                                             
    {

        // static::deleting(function (self $user) {
        //     optional($user->photos)->each(function (Photo $photo) {
        //         $photo->delete();
        //     });
        // });
    }
    

}
