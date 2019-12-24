<?php
/**
 * @todo Analisar, provavelmente tera que sair
 */

namespace Population\Models\Identity\Actors\Business;

use Population\Models\Identity\Actors\Person;

class Collaborator extends Person
{

    protected $organizationPerspective = true;

    protected $table = 'business_collaborators';       

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'person_id',
        'business_id',
        'business_collaborator_type_id',
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


    public function gateway()
    {
        return $this->belongsTo('App\Models\Gateway', 'gateway_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

}