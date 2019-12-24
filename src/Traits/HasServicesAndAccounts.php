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

use Informate\Traits\AsFofocavel;
use Informate\Traits\MakeEconomicActions;

trait HasServicesAndAccounts
{
    /**
     * Get all of the post's accounts.
     */
    public function accounts()
    {
        return $this->morphToMany('Population\Models\Identity\Digital\Account', 'accountable');
    }

    

}
