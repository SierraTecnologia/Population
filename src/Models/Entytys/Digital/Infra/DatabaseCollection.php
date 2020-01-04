<?php
/**
 * Bancos dentro do Servidor do Database
 */

namespace Population\Models\Entytys\Digital\Infra;

use Support\Models\Base;

class DatabaseCollection extends Base
{

    public static $apresentationName = 'Tabelas dentro de Databases';

    protected $organizationPerspective = true;

    protected $table = 'infra_database_collections';       

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'infra_database_id',
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

    public function getName()
    {
        return $this->name;
    }

    public function getApresentationName()
    {
        return $this->getName();
        // // @todo Entender isso aqui
        // return $this->database->getApresentationName().' - '.$this->name;
    }


    public function database()
    {
        return $this->belongsTo('Population\Models\Entytys\Digital\Infra\Database', 'infra_database_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}