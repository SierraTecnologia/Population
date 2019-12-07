<?php
/**
 * Ex: https://www.xvideos.com/video26396499/bound_bdsm_sub_raven_bay_facefucked
 *  */

namespace Population\Models\Market\Actors;

use Informate\Models\Model;

class XtremeSlave extends Slave
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'cpf',
        'email',
        'role_id'
    ];

    protected $mappingProperties = array(
        /**
         * User Info
         */
        'name' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'cpf' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'email' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],

        /**
         * Grupo de Usuário:
         * 
         * 3 -> Usuário de Produtora
         * Default: 3
         */
        'role_id' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );

    public function orders()
    {
        return $this->hasMany('App\Models\Order', 'customer_id', 'id');
    }

    public function analysis()
    {
        return $this->hasMany('App\Models\Analysi', 'analysi_id', 'id');
    }

    /**
     * Get the tokens record associated with the user.
     */
    public function customerTokens()
    {
        return $this->hasMany('App\Models\CustomerToken', 'customer_id', 'id');
    }

    /**
     * Recupera os tokens de gateways desse usuário
     */
    public function gatewayCustomers()
    {
        return $this->hasMany('App\Models\GatewayCustomer', 'customer_id', 'id');
    }
}
