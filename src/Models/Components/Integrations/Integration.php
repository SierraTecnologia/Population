<?php

namespace Population\Models\Components\Integrations;

use Support\Models\Base;

class Integration extends Base
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'url',
        'code',
        'description'
    ];

    protected $mappingProperties = array(
        /**
         * User Info
         */
        'name' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'url' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'code' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'description' => [
            'type' => 'string',
            "analyzer" => "standard",
        ]
    );

    // public function orders()
    // {
    //     return $this->hasMany('App\Models\Order', 'customer_id', 'id');
    // }

    // public function analysis()
    // {
    //     return $this->hasMany('App\Models\Analysi', 'analysi_id', 'id');
    // }

    // /**
    //  * Get the tokens record associated with the user.
    //  */
    // public function customerTokens()
    // {
    //     return $this->hasMany('config('sitec.core.models.person', \Population\Models\Identity\Actors\Person::class)Token', 'customer_id', 'id');
    // }

    // /**
    //  * Recupera os tokens de gateways desse usuário
    //  */
    // public function gatewayCustomers()
    // {
    //     return $this->hasMany('App\Models\GatewayCustomer', 'customer_id', 'id');
    // }

    /**
     * Get all of the slaves that are assigned this tag.
     */
    public function persons()
    {
        return $this->morphedByMany('Population\Models\Identity\Actors\Person', 'personable');
    }

}
