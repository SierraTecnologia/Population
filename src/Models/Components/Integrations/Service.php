<?php

namespace Population\Models\Components\Integrations;

use Support\Models\Base;

class Service extends Base
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description'
    ];

    protected $mappingProperties = array(
        'name' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'description' => [
            'type' => 'string',
            "analyzer" => "standard",
        ]
    );

    public function integration()
    {
        return $this->belongsTo(Integration::class);
    }

}
