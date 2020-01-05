<?php

namespace Population\Models\Entytys\Digital\Infra;

use Support\Models\Base;

class DominioRule extends Base
{

    protected $organizationPerspective = true;

    protected $table = 'infra_dominio_rules';       

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'infra_domain_id',
        'user_id',
    ];


    protected $mappingProperties = array(

        'infra_domain_id' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],
        'credit_card_id' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],
        'user_id' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],
        'docker_compose_file' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );


    public function user()
    {
        return $this->belongsTo(config('sitec.core.models.user', \App\Models\User::class), 'user_id', 'id');
    }

}