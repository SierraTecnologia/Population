<?php

namespace Population\Models\Entytys\Digital\Infra;

use Support\Models\Base;

class Service extends Base
{

    protected $organizationPerspective = false;

    protected $table = 'infra_services';       

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
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


    public function user()
    {
        return $this->belongsTo(config('sitec.core.models.user', \App\Models\User::class), 'user_id', 'id');
    }

}