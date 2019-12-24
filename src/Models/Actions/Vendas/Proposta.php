<?php

namespace Population\Models\Actions\Vendas;

use Siravel\Models\Model;

class Proposta extends Base
{

    protected $organizationPerspective = true;

    protected $table = 'propostas';       

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'value',
        'parcelas',
        'money_id',
        'date',
        
    ];
}