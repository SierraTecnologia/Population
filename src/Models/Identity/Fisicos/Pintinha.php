<?php

namespace Informate\Models\Entytys\Fisicos;

use Informate\Models\Model;

class Pintinha extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'pintinha_id'
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
        'pintinha_id' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );

    /**
     * Get all of the owning pintinhable models.
     */
    public function pintinhable()
    {
        // @todo Verificar depois //return $this->morphTo();
    }
}
