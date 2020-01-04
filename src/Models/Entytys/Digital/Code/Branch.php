<?php

namespace Population\Models\Entytys\Digital\Code;

use Support\Models\Base;

class Branch extends Base
{

    protected $organizationPerspective = true;

    protected $table = 'code_project_branchs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code_project_id',
        'code_project_commit_id',
    ];

    public function getApresentationName()
    {
        return 'Branch '.$this->name;
    }

    public function project()
    {
        return $this->belongsTo('Population\Models\Entytys\Digital\Code\Project', 'code_project_id', 'id');
    }

}