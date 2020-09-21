<?php 

namespace Population\Models\Components\Book\Permissions;

use Pedreiro\Models\Base;

class EntityPermission extends Base
{

    protected $fillable = ['role_id', 'action'];
    public $timestamps = false;

    /**
     * Get all this restriction's attached entity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function restrictable()
    {
        return $this->morphTo('restrictable');
    }
}
