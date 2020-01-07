<?php
/**
 * @todo Fazer Modelo
 */

namespace Population\Models\Entytys\Digital\Code;

use Support\Models\Base;

class ProjectMember extends Base
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cpf',
        'card_name',
        'brand_id',
        'card_number',
        'exp_year',
        'exp_month',
        'cvc',
        'is_active'
    ];

    protected $mappingProperties = array(

        /**
         * Informações do Dono
         */
        'cpf' => [
          'type' => 'string',
          "analyzer" => "standard",
        ],
        'card_name' => [
          'type' => 'string',
          "analyzer" => "standard",
        ],

        /**
         * Cartão de Crédito
         */
        'brand_id' => [
          'type' => 'id',
          "analyzer" => "standard",
        ],
        'card_number' => [
          'type' => 'string',
          "analyzer" => "standard",
        ],
        'exp_year' => [
          'type' => 'string',
          "analyzer" => "standard",
        ],
        'exp_month' => [
          'type' => 'string',
          "analyzer" => "standard",
        ],

        // CVV
        'cvc' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],

        // Se esta ativado para Compra ou Bloqueado
        'is_active' => [
          'type' => 'string',
          "analyzer" => "standard",
        ],
    );

}