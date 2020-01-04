<?php

namespace Population\Models\Entytys\Digital\Infra;

use Support\Models\Base;
use Population\Models\Entytys\Digital\Internet\Url;

class Domain extends Base
{

    public static $apresentationName = 'Dominios';

    protected $organizationPerspective = true;

    protected $table = 'infra_domains';       

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'status',
        'user_id',
    ];


    protected $mappingProperties = array(

        'url' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'status' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'user_id' => [
            'type' => 'integer',
            "analyzer" => "standard",
        ],
    );

    public function getApresentationName()
    {
        return $this->url;
    }

    public function getRootPage()
    {
        if (!$url = $this->urls()->first()){
            $url = Url::create([
                'infra_domain_id' => $this->id,
                'url' => $this->url.'/',
            ]);
        }
        return $url;
    }

    public function urls()
    {
        return $this->hasMany('Population\Models\Entytys\Digital\Internet\Url', 'infra_domain_id', 'id');
    }
}