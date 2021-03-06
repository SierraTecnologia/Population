<?php

namespace Population\Models\Identity\Subjetivos;

use Pedreiro\Models\Base;

class Fato extends Base
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


    // public function links()
    // {
    //     return $this->sitios();
    // }

    // public function sitios()
    // {
    //     return $this->morphToMany('Telefonica\Models\Digital\Sitio', 'videoable');
    // }

    // /**
    //  * Get all of the users that are assigned this tag.
    //  */
    // public function users()
    // {
    //     return $this->morphToMany(\Illuminate\Support\Facades\Config::get('sitec.core.models.user', \App\Models\User::class), 'videoable');
    // }

    // /**
    //  * Get all of the persons that are assigned this tag.
    //  */
    // public function persons()
    // {
    //     return $this->morphToMany(\Illuminate\Support\Facades\Config::get('sitec.core.models.person', \Telefonica\Models\Actors\Person::class), 'videoable');
    // }

    /**
     * Get all of the owning fatoable models.
     * 
     * Usa esse aqui pois é apenas um fato por modelo
     */
    public function fatoable()
    {
        return $this->morphTo();
    }
}
