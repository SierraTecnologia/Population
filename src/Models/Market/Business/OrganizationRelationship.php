<?php

namespace Population\Models\Identity\Actors\Business;

use Support\Models\Base;

class BusinesstionRelationship extends Base
{

    protected $organizationPerspective = false;

    protected $table = 'business_businesstion_relationships';       

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
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
        'score' => [
            'type' => 'float',
            "analyzer" => "standard",
        ],
    );


    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

}