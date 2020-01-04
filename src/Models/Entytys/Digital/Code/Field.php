<?php

namespace Population\Models\Entytys\Digital\Code;

use Support\Models\Base;

class Field extends Base
{

    protected $organizationPerspective = false;

    protected $table = 'code_fields';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
    
}