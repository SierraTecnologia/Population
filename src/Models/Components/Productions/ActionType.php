<?php

namespace Population\Models\Components\Productions;

/**
 * Tipos de Produções
 */
use Population\Models\Model;

class ActionType extends Model
{

    protected $table = 'production_action_types';

    /**
     * Se é uma decisão capitalista ou não (Escolha Voluntária ou não)
     *
     * @var array
     */
    public static $TALK = 1;

    /**
     * Decisão Politica  (Escolha Coersitiva)
     *
     * @var array
     */
    public static $RPG = 2;

    /**
     * Seriados
     *
     * @var array
     */
    public static $SERIADOS = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'capitalist',
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
}