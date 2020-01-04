<?php

namespace Population\Models\Entytys\Digital\Code;

use Support\Models\Base;

class Stage extends Base
{

    protected $organizationPerspective = false;

    protected $table = 'code_stages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
    
}