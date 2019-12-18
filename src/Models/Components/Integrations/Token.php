<?php
/**
 * Armazena casas de cambios que aceitam trocar moedas
 */

namespace Population\Models\Components\Integrations;

use Population\Models\Model;

class Token extends Model
{

    
    protected $organizationPerspective = false;

    public static $apresentationName = 'Tokens';

    protected $table = 'integration_tokens';       

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account',
        'token',
        'integration_id',
        'obs',
        'scopes',
        'status'
    ];

     /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'scopes' => 'json',
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

    public function getApresentationName()
    {
        return 'Tokens de Serviços';
    }
}