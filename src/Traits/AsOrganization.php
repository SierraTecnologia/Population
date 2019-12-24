<?php

namespace Population\Traits;

use Log;
// Podem Seguir
use Overtrue\LaravelFollow\Traits\CanFollow;
use Overtrue\LaravelFollow\Traits\CanLike;
use Overtrue\LaravelFollow\Traits\CanFavorite;
use Overtrue\LaravelFollow\Traits\CanSubscribe;
use Overtrue\LaravelFollow\Traits\CanVote;
use Overtrue\LaravelFollow\Traits\CanBookmark;
// Podem Serem Seguidos
use Overtrue\LaravelFollow\Traits\CanBeFollowed;

use Informate\Traits\HasPersonality;

trait AsOrganization
{
    use MakeEconomicActions, HasPersonality;
    use HasServicesAndAccounts, HasContacts, AsFofocavel;

    use CanFollow, CanLike, CanFavorite, CanSubscribe, CanVote, CanBookmark;
    use CanBeFollowed;

    /**
     * Aparece em videos
     */
    public function videos()
    {
        return $this->morphToMany('Informate\Models\Entytys\Digital\Midia\Video', 'videoable');
    }

    /**
     * Aparece em fotos
     */
    public function imagens()
    {
        return $this->morphToMany('Informate\Models\Entytys\Digital\Midia\Imagen', 'imagenable');
    }


    /**
     * Worker e Tarefas
     */
    public function workers()
    {
        return $this->morphMany('Casa\Models\Economic\Worker', 'workerable');
    }
    public function fatos()
    {
        return $this->morphMany('Population\Models\Identity\Subjetivos\Fato', 'fatoable');
    }
        
    /**
     * Get all of the owning personable models.
     */
    public function savePassword($password = '', $type = '')
    {
        // @todo Fazer
        return true;
    }

    /**
     * Events
     */
    public static function bootAsOrganization()                                                                                                                                                             
    {

        // static::deleting(function (self $user) {
        //     optional($user->photos)->each(function (Photo $photo) {
        //         $photo->delete();
        //     });
        // });
    }
    

}
