<?php
/**
 * Armazena casas de cambios que aceitam trocar moedas
 */

namespace Population\Models\Components\Integrations;

use Population\Models\Model;

class TokenAccess extends Model
{

    
    protected $organizationPerspective = false;

    protected $table = 'integration_token_accesses';       

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'model',
        'model_id',
        'token_id',
        'integration_service_id',
        'status'
    ];


    protected $mappingProperties = array(

        'name' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'status' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );

    // public function user()
    // {
    //     return $this->belongsTo('App\Models\User', 'user_id', 'id');
    // }
}