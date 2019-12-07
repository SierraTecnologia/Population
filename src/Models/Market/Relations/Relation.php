<?php

namespace Population\Models\Market\Relations;

use Informate\Models\Model;

class Relation extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bottom_code',
        'top_code',
        'name_relation_to',
        'name_relation_from',
    ];

    protected $mappingProperties = array(
        /**
         * User Info
         */
        'name' => [
            'type' => 'string',
            "analyzer" => "standard",
        ],
    );

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bottom()
    {
        return $this->belongsTo(Position::class, 'bottom_code', 'code');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function top()
    {
        return $this->belongsTo(Position::class, 'top_code', 'code');
    }
}
