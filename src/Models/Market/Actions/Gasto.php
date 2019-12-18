<?php

namespace Population\Models\Market\Actions;

use Population\Models\Model;
use Informate\Traits\ComplexRelationamentTrait;

class Gasto extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'value',
        'init',
        'end',
    ];

    protected $mappingProperties = array(
        'description' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'value' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );
    
    /**
     * Get all of the slaves that are assigned this tag.
     */
    public function persons()
    {
        return $this->morphedByMany('Population\Models\Identity\Actors\Person', 'gastoable');
    }

    /**
     * Get all of the users that are assigned this tag.
     */
    public function users()
    {
        return $this->morphedByMany('App\Models\User', 'gastoable');
    }
}
