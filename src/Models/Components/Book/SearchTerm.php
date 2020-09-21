<?php

namespace Population\Models\Components\Book;

use Pedreiro\Models\Base;

class SearchTerm extends Base
{

    protected $fillable = ['term', 'entity_id', 'entity_type', 'score'];
    public $timestamps = false;

    /**
     * Get the entity that this term belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function entity()
    {
        return $this->morphTo('entity');
    }
}
