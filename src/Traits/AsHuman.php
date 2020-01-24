<?php

namespace Population\Traits;

use Log;

trait AsHuman
{
    use AsOrganization;

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
