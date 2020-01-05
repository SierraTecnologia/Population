<?php

namespace Population\Models\Entytys\Digital\Infra;

use Support\Models\Base;

class DatabaseTable extends Base
{

    protected $organizationPerspective = true;

    protected $table = 'infra_database_tables';       

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model',
        'model_id',
        'credit_card_id',
        'user_id',
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

    public function collection()
    {
        return $this->belongsTo('Population\Models\Entytys\Digital\Infra\DatabaseCollection', 'collection_id', 'id');
    }
}