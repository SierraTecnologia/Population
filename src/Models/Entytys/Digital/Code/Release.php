<?php

namespace Population\Models\Entytys\Digital\Code;

use Support\Models\Base;

class Release extends Base
{

    protected $organizationPerspective = true;

    protected $table = 'code_releases';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'status',
        'start',
        'release',
        'code_project_id',
    ];
    

}