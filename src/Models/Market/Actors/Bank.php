<?php

namespace Population\Models\Market\Actors;

use Informate\Models\Model;
use Informate\Traits\ComplexRelationamentTrait;

class Bank extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'name',
        'code',
        // 'name',
        // 'agencia',
        // 'conta',
    ];

    protected $mappingProperties = array(
        'description' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'name' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'code' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'agencia' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'conta' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );
    
    /**
     * Get all of the slaves that are assigned this tag.
     */
    public function slaves()
    {
        return $this->morphedByMany('Population\Models\Identity\Slave', 'bankable');
    }

    /**
     * Get all of the users that are assigned this tag.
     */
    public function users()
    {
        return $this->morphedByMany('App\Models\User', 'bankable');
    }
}
