<?php

namespace Population\Models\Market\Abouts;

use Support\Models\Base;

class Info extends Base
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
