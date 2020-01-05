<?php

namespace Population\Models\Components\Productions;

/**
 * Tipos de Produções
 */
use Support\Models\Base;

class SceneLocal extends Base
{

    protected $table = 'production_scene_locals';



    
    /**
     * Get all of the slaves that are assigned this tag.
     */
    public function persons()
    {
        return $this->morphedByMany('Population\Models\Identity\Actors\Person', 'skillable');
    }

    /**
     * Get all of the users that are assigned this tag.
     */
    public function users()
    {
        return $this->morphedByMany(config('sitec.core.models.user', \App\Models\User::class), 'skillable');
    }
}