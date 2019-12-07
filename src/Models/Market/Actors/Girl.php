<?php

namespace Population\Models\Market\Actors;

use Population\Models\Model;

class Girl extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'user_id'
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
        'user_id' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );
    
    public function infos()
    {
        return $this->morphMany('Population\Models\Market\Abouts\Info', 'infoable');
    }

    /**
     * Get all of the skills for the post.
     */
    public function skills()
    {
        return $this->morphToMany('Informate\Models\Entytys\About\Skill', 'skillable');
    }

}
