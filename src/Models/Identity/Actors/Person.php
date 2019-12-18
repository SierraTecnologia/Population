<?php

namespace Population\Models\Identity\Actors;

use Population\Models\Model;
use Population\Traits\AsHuman;
use Cocur\Slugify\Slugify;

class Person extends Model
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
    
    public static function returnOrCreateByCode()
    {
        $slugify = new Slugify();
        
        $code = $slugify->slugify($code, '.'); // hello-world

    }
    
    public static function cleanCodeSlug($slug)
    {
        $slugify = new Slugify();
        
        $slug = $slugify->slugify($slug, '.'); // hello-world
        
        return $slug;
    }

    // @todo resolver problema do nome vazio
    // public static function boot() {

    //     static::creating(function ($model) {
    //         if (empty($model->name)) {
    //             $model->name = $model->code;
    //         }
    //     });
    // }
}
