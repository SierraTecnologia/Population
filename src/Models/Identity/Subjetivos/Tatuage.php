<?php

namespace Informate\Models\Entytys\Subjetivos;

use Informate\Models\Model;

class Fato extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'fato_id'
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
        'fato_id' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );


    /**
     * Get all of the owning fatoable models.
     */
    public function fatoable()
    {
        // @todo Verificar depois //return $this->morphTo();
    }
}
