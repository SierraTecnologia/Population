<?php namespace Population\Models\Components\Book\Permissions;

use App\Models\Role;
use Pedreiro\Models\Base;

class RolePermission extends Base
{
    /**
     * The roles that belong to the permission.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role', 'permission_id', 'role_id');
    }

    /**
     * Get the permission object by name.
     *
     * @param  $name
     * @return mixed
     */
    public static function getByName($name)
    {
        return static::where('name', '=', $name)->first();
    }
}
