<?php

namespace Population\Models\Identity\Actors;

use Support\Models\Base;
use Population\Traits\AsHuman;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Support\Utils\Modificators\StringModificator;

class Person extends Base implements HasMedia
{
    use AsHuman;

    protected $table = 'persons';  
    
    public $incrementing = false;
    protected $casts = [
        'code' => 'string',
    ];
    protected $primaryKey = 'code';
    protected $keyType = 'string'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'cpf'
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

    public function save(array $options = [])
    {
        // @todo repassar isso pro model base
        // If no author has been assigned, assign the current user's id as the author of the post
        if (!$this->name || empty($this->name)) {
            $this->name = StringModificator::convertSlugToName($this->code);
        }

        parent::save();
    }

    public function users()
    {
        return $this->morphedByMany(config('sitec.core.models.user', \App\Models\User::class), 'personable'); //, 'businessable_type', 'businessable_code');
    }
}
