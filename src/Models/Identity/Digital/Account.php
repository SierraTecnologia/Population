<?php

namespace Population\Models\Identity\Digital;

use Support\Models\Base;
use Informate\Traits\ComplexRelationamentTrait;
use Population\Models\Components\Integrations\Integration;
use Population\Models\Identity\Actors\Business;

class Account extends Base
{
    // use ComplexRelationamentTrait;
    
    // protected static $COMPLEX_RELATIONAMENT_MODELS = [
    //     \App\Models\Photo::class,
    //     \App\Models\Video::class
    // ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'email',
        'customize_url',
        'status',
        'integration_id',
    ];

    protected $mappingProperties = array(
        'username' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'password' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'email' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'customize_url' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
        'integration_id' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );

    /**
     * Get all of the business that are assigned this tag.
     */
    public function business()
    {
        return $this->morphedByMany(Business::class, 'accountable');
    }

    /**
     * Get all of the users that are assigned this tag.
     */
    public function users()
    {
        return $this->morphedByMany('App\Models\User', 'accountable');
    }

    /**
     * Get all of the persons that are assigned this tag.
     */
    public function persons()
    {
        return $this->morphedByMany('Population\Models\Identity\Actors\Person', 'accountable');
    }

    /**
     * Relation for the user that created this entity.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function integration()
    {
        return $this->belongsTo(Integration::class);
    }


    public function save(array $options = [])
    {
        // If no author has been assigned, assign the current user's id as the author of the post
        if (!$this->username || empty($this->username)) {
            $this->username = $this->email;
        }

        parent::save();
    }
}
