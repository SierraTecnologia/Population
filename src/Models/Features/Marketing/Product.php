<?php

namespace Population\Models\Features\Marketing;

use Support\Models\Base;
use Informate\Traits\ComplexRelationamentTrait;

class Product extends Base
{
    use ComplexRelationamentTrait;
    
    protected static $COMPLEX_RELATIONAMENT_MODELS = [
        \Stalker\Models\Photo::class,
        \Stalker\Models\Video::class
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'time', // im segundos
        'money_code',
        'money_value',
        'model',
        'model_id'
    ];

    protected $mappingProperties = array(
        /**
         * User Info
         */
        'name' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'cpf' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'email' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],

        /**
         * Grupo de Usuário:
         * 
         * 3 -> Usuário de Produtora
         * Default: 3
         */
        'role_id' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );
    
    /**
     * Get all of the girls that are assigned this tag.
     */
    public function girls()
    {
        return $this->morphedByMany('Population\Models\Market\Actors\Girl', 'skillable');
    }

    /**
     * Get all of the users that are assigned this tag.
     */
    public function users()
    {
        return $this->morphedByMany(\Illuminate\Support\Facades\Config::get('sitec.core.models.user', \App\Models\User::class), 'skillable');
    }
}
