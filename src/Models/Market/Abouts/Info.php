<?php

namespace Population\Models\Market\Abouts;

use Population\Models\Model;

class Info extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'text'
    ];

    protected $mappingProperties = array(
        'text' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );

    /**
     * Get all of the owning infoable models.
     */
    public function infoable()
    {
        return $this->morphTo();
    }
}
