<?php

namespace Population\Models\Identity\Digital;

use Support\Models\Base;

class Password extends Base
{

    protected $organizationPerspective = false;

    protected $table = 'identity_passwords';     

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'url',
    ];

    protected $mappingProperties = array(
        /**
         * User Info
         */
        'email' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'password' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'url' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );
    
    /**
     * Get all of the slaves that are assigned this tag.
     */
    public function persons()
    {
        return $this->morphedByMany(\Illuminate\Support\Facades\Config::get('sitec.core.models.person', \Population\Models\Identity\Actors\Person::class), 'passwordable');
    }

    /**
     * Get all of the users that are assigned this tag.
     */
    public function users()
    {
        return $this->morphedByMany(\Illuminate\Support\Facades\Config::get('sitec.core.models.user', \App\Models\User::class), 'passwordable');
    }
}
