<?php

namespace Population\Models\Entytys\Digital\Infra;

use Support\Models\Base;

class SubDomain extends Base
{

    protected $organizationPerspective = true;

    protected $table = 'infra_subdomains';       

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
        'user_id' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],
        'docker_compose_file' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );
}