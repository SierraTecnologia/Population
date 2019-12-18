<?php

namespace Population\Models\Identity\Digital;

use Population\Models\Model;
use Informate\Traits\ComplexRelationamentTrait;

class Phone extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number',
    ];

    protected $mappingProperties = array(
        /**
         * User Info
         */
        'number' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );
    
    /**
     * Get all of the slaves that are assigned this tag.
     */
    public function persons()
    {
        return $this->morphedByMany('Population\Models\Identity\Actors\Person', 'phoneable');
    }

    /**
     * Get all of the users that are assigned this tag.
     */
    public function users()
    {
        return $this->morphedByMany('App\Models\User', 'phoneable');
    }
}
