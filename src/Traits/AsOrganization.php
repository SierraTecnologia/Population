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
use Casa\Traits\MakeEconomicActions;
use Casa\Traits\HasTask;
use Casa\Traits\HasRoutine;

trait AsOrganization
{
    use HasPersonality;
    use MakeEconomicActions, HasTask, HasRoutine;
    use HasServicesAndAccounts, HasContacts, AsFofocavel;

    use CanFollow, CanLike, CanFavorite, CanSubscribe, CanVote, CanBookmark;
    use CanBeFollowed;

    use HasPhoto;

    /**
     * Aparece em videos
     */
    public function videos()
    {
        return $this->morphToMany('Finder\Models\Digital\Midia\Video', 'videoable');
    }

    /**
     * Aparece em fotos
     */
    public function imagens()
    {
        return $this->morphToMany('Finder\Models\Digital\Midia\Imagen', 'imagenable');
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
     * 
     */

    /**
     * Projetos do Usuario - Refazer
     *
     * @param  array $data
     * @return void
     */
    public function addProject($data)
    {
        // @todo Refazer
        return $this->infos()->create(
            [
            'text' => implode(';', $data)
            ]
        );
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
