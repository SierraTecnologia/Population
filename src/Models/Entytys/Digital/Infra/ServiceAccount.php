<?php

namespace Population\Models\Entytys\Digital\Infra;

use Support\Models\Base;

class ServiceAccount extends Base
{

    protected $organizationPerspective = false;

    protected $table = 'infra_service_accounts';       

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'infra_service_id',
    ];


    protected $mappingProperties = array(

        'customer_id' => [
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


    public function service()
    {
        return $this->belongsTo('Population\Models\Entytys\Digital\Infra\Service', 'infra_service_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    
}