<?php

namespace Population\Models\Market\Actions;

use Informate\Models\Model;

class VagaCandidato extends Model
{

    protected $organizationPerspective = false;

    protected $table = 'vaga_candidatos';       

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'salario',
        'person_id',
        'vaga_id',
    ];


    protected $mappingProperties = array(

        'salario' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'person_id' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],
        'vaga_id' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],
    );


}