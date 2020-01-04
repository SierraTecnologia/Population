<?php

namespace Population\Models\Entytys\Digital\Internet;

use Informate\Traits\ArchiveTrait;

use Carbon\Carbon;
use Config;
use FileService;
use Exception;
use Illuminate\Support\Facades\Cache;
use Log;
use Intervention\Image\ImageManagerStatic as InterventionImage;
use Storage;

class ComputerFile extends ArchiveTrait
{
    public $table = 'computer_files';

    public $primaryKey = 'id';

    protected $guarded = [];

    protected $appends = [
        'name',
        'location',

        'path', //"/home/sierra/Desenvolvimento/Libs/Finder/."
        'filename', //"composer.json"
        'basename', //"composer.json"
        'pathname', //"/home/sierra/Desenvolvimento/Libs/Finder/./composer.json"
        'extension', //"json"
        'realPath', //"./composer.json"
        'aTime', //2019-12-03 08:23:37
        'mTime', //2019-12-03 08:23:37
        'cTime', //2019-12-03 08:23:37
        'inode', //51930963
        'size', //2902
        'perms', //0100644
        'owner', //1000
        'group', //1000
        'type', //"file"
        'writable', //true
        'readable', //true
        'executable', //false
        
        'file', //true
        'dir', //false
        'link', //false
    ];

    public $rules = [
        
    ];

}
