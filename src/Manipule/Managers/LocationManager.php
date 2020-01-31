<?php

namespace Population\Manipule\Managers;

use Population\Manipule\Entities\LocationEntity;

/**
 * Interface LocationManager.
 *
 * @package Core\Contracts
 */
interface LocationManager
{
    /**
     * Create a location.
     *
     * @param array $attributes
     * @return LocationEntity
     */
    public function create(array $attributes): LocationEntity;
}
