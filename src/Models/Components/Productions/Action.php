<?php
/**
 * Alguma ação que ocorra dentro da Produção
 */

namespace Population\Models\Components\Productions;

use Support\Models\Base;

class Action extends Base
{

    protected $table = 'production_actions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'production_action_type_id',
        'target_id',
        'before_scene_id',
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
}