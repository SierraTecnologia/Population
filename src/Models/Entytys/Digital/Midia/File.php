<?php

namespace Population\Models\Entytys\Digital\Midia;

use Informate\Traits\ArchiveTrait;

class File extends ArchiveTrait
{
    public $table = 'files';

    public $primaryKey = 'id';

    protected $guarded = [];

    public $rules = [
        'location' => 'required',
    ];
}
