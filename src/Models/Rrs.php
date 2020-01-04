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

namespace Population\Models;

use Support\Models\Base;

class Rrs extends Base
{

    protected $table = 'rrs';       

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'content',
        'author',
        'service_id',
    ];

    // @todo Criar Modelo Artigo
    // public function articles()
    // {
    //     return $this->hasMany('App\Models\Article');
    // }
}