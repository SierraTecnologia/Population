<?php

namespace Population\Models\Market\Relations;

use Population\Models\Model;

class Integration extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'skill_id'
    ];

    protected $mappingProperties = array(
        /**
         * User Info
         */
        'name' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'description' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'skill_id' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );

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
        return $this->morphedByMany('App\Models\User', 'skillable');
    }
}
