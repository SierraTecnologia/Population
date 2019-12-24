<?php

namespace Population\Traits;

use Log;

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
