<?php

namespace Population\Models\Identity\Fisicos;

use Population\Models\Model;

class Tatuage extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'tatuage_id'
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
        'tatuage_id' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );


    /**
     * Get all of the owning tatuageable models.
     */
    public function tatuageable()
    {
        return $this->morphTo();
    }
}
