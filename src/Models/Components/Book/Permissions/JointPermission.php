<?php namespace Population\Models\Components\Book\Permissions;

use App\Models\Role;
use Population\Models\Components\Book\Entity;
use Pedreiro\Models\Base;

class JointPermission extends Base
{
    public $timestamps = false;

    /**
     * Get the role that this points to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the entity this points to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function entity()
    {
        return $this->morphOne(Entity::class, 'entity');
    }
}
