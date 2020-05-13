<?php

namespace Population\Models\Identity\Digital;

use Support\Models\Base;

class Email extends Base
{
    public $incrementing = false;
    protected $casts = [
        'email' => 'string',
    ];
    protected $primaryKey = 'email';
    protected $keyType = 'string'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'address',
        'domain',
        'integration_id',
    ];

    protected $mappingProperties = array(
        /**
         * User Info
         */
        'email' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );
    
    /**
     * Get all of the slaves that are assigned this tag.
     */
    public function associations($class)
    {
        return $this->morphedByMany($class, 'emailable'); //, 'emailables', 'email_email', 'emailable_code', 'emailable_type');
    }
    
    /**
     * Get all of the slaves that are assigned this tag.
     */
    public function persons()
    {
        return $this->morphedByMany(\Illuminate\Support\Facades\Config::get('sitec.core.models.person', \Population\Models\Identity\Actors\Person::class), 'emailable');
    }

    /**
     * Get all of the users that are assigned this tag.
     */
    public function users()
    {
        return $this->morphedByMany(\Illuminate\Support\Facades\Config::get('sitec.core.models.user', \App\Models\User::class), 'emailable');
    }
}
