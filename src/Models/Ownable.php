<?php 

namespace Population\Models;

use App\Models\User;
use Support\Models\Base;
use Support\Components\Coders\Parser\ParseClass;

abstract class Ownable extends Base
{
    /**
     * Relation for the user that created this entity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo(\Illuminate\Support\Facades\Config::get('sitec.core.models.user', \App\Models\User::class), 'created_by');
    }

    /**
     * Relation for the user that updated this entity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updatedBy()
    {
        return $this->belongsTo(\Illuminate\Support\Facades\Config::get('sitec.core.models.user', \App\Models\User::class), 'updated_by');
    }

    /**
     * Gets the class name.
     *
     * @return string
     */
    public static function getClassName()
    {
        return ParseClass::getClassName(static::class);
    }
}
