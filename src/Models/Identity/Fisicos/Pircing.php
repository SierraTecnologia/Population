<?php

namespace Informate\Models\Entytys\Fisicos;

use Informate\Models\Model;

class Pircing extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'pircing_id'
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
        'pircing_id' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );

    /**
     * Get all of the owning pircingable models.
     */
    public function pircingable()
    {
        // @todo Verificar depois //return $this->morphTo();
    }
}
