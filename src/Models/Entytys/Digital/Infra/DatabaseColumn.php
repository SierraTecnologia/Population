<?php

namespace Population\Models\Entytys\Digital\Infra;

use Support\Models\Base;

class DatabaseColumn extends Base
{

    protected $organizationPerspective = true;

    protected $table = 'infra_database_columns';       

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
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function table()
    {
        return $this->belongsTo('App\Models\DatabaseTable', 'table_id', 'id');
    }
}