<?php

/**
 * Class Responsável por separar acessos e regras de negócios.
 * 
 * Hierarquia:
 * -> Deus (Controle os admins e seus acessos)
 * -> Admin (Tem acessos aos usuários do payment, com as diferentes regras de negócio)
 * -> User (Diferentes braços e parcerias da empresa, com proprios gateways, contratos e tokens)
 * -> Client (Cliente do User, quem irá receber o dinheiro)
 * -> Customer (Consumidor Final, pagando e adquirindo os produtos do cliente)
 */

namespace Population\Models\Features;

use Informate\Models\Model;

class Estatistica extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fonte',
        'nome',
        'periodo',
        'date',
        'result',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'extra_type' => 'array',
    ];

 
}