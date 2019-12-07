<?php

namespace Population\Models\Market\Actions;

use Informate\Models\Model;

class Vaga extends Model
{

    protected $organizationPerspective = false;

    protected $table = 'vagas';       

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'salario',
        'code',
        'url',
    ];


    protected $mappingProperties = array(

        'salario' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'code' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'url' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],
    );


}