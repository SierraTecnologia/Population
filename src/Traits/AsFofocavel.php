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
