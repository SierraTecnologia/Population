<?php

namespace Population\Models\Components\Book;

use Population\Models\Model;

class SearchTerm extends Model
{

    protected $fillable = ['term', 'entity_id', 'entity_type', 'score'];
    public $timestamps = false;

    /**
     * Get the entity that this term belongs to
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function entity()
    {
        return $this->morphTo('entity');
    }
}