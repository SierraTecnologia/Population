<?php

namespace Population\Models\Actions\Gamification;

use Siravel\Models\Model;

class Point extends Base
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'pointable_type',
        'pointable_id',
        'point_type_id'
    ];

    protected $mappingProperties = array(
        /**
         * User Info
         */
        'name' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'pointable_type' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'pointable_id' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'point_type_id' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );

    /**
     * Get all of the users that are assigned this tag.
     */
    public function users()
    {
        return $this->morphedByMany('App\Models\User', 'pointable');
    }

    /**
     * Get all of the slaves that are assigned this tag.
     */
    public function persons()
    {
        return $this->morphedByMany('App\Models\Slave', 'pointable');
    }
}
