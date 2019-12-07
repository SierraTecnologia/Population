<?php

namespace Population\Models\Identity\Digital;

use Informate\Models\Model;

class Sitio extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'url',
        'sitio_id'
    ];

    protected $mappingProperties = array(
        'name' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'url' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'sitio_id' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );

    /**
     * Get all of the businesses that are assigned this tag.
     */
    public function businesses()
    {
        return $this->morphedByMany(config('sitec-tools.models.business'), 'sitioable');
    }

    /**
     * Get all of the girls that are assigned this tag.
     */
    public function girls()
    {
        return $this->morphedByMany('Population\Models\Identity\Girl', 'sitioable');
    }

    /**
     * Get all of the users that are assigned this tag.
     */
    public function users()
    {
        return $this->morphedByMany('App\Models\User', 'sitioable');
    }
}
