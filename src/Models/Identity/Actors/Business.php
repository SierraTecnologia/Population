<?php

namespace Population\Models\Identity\Actors;

use Support\Models\Base;
use Population\Traits\AsHuman;
use Cocur\Slugify\Slugify;
use Population\Traits\AsOrganization;

class Business extends Base
{
    use AsOrganization;

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
        'name',
        'code',
        'language_code',
        'money_code',
        'user_id'
    ];

    protected $mappingProperties = array(
        'name' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'code' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'language_code' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'money_code' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'user_id' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );
        
    // /**
    //  * Get all of the owning businessable models.
    //  */
    // @todo A relacao porliformica é diferente nesse caso, podemos ter varias pessoas associadas ao mesmo item.
    // public function businessable()
    // {
    //     return $this->morphTo(); //, 'businessable_type', 'businessable_code'
    // }

    /**
     * Get all of the users that are assigned this tag.
     */
    public function users()
    {
        return $this->morphedByMany(\Illuminate\Support\Facades\Config::get('sitec.core.models.user', \App\Models\User::class), 'businessable'); //, 'businessable_type', 'businessable_code');
    }
    public function collaborators()
    {
        return $this->morphedByMany(Person::class, 'businessable'); //, 'businessable_type', 'businessable_code');
    }


}