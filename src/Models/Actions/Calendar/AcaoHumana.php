<?php
/**
 * Um Evento INdividual
 */

namespace Population\Models\Actions\Calendar;

use App\Models\CmsModel as BaseModel;
use Siravel\Services\Normalizer;
use Informate\Traits\Translatable;
use Log;
use Illuminate\Database\Eloquent\SoftDeletes;
use Informate\Traits\BusinessTrait;

class AcaoHumana extends BaseModel
{
    use Translatable, SoftDeletes;

    public $table = 'acao_humanas';

    public $primaryKey = 'id';

    protected $guarded = [];

    public static $rules = [
        'title' => 'required',
    ];

    protected $appends = [
        'translations',
    ];

    protected $fillable = [
        'start_init',
        'people_slug',
        'title',
        'details',
        'seo_description',
        'seo_keywords',
        'is_published',
        'fingerprint',
        'template',
        'published_at',
    ];

    protected $dates = [
        'published_at' => 'Y-m-d H:i'
    ];

    public function __construct(array $attributes = [])
    {
        $keys = array_keys(request()->except('_method', '_token'));
        $this->fillable(array_values(array_unique(array_merge($this->fillable, $keys))));
        parent::__construct($attributes);
    }
    
    public function addInfo($slug, $info)
    {
        Log::info("$slug, $info");
    }
    
    public function addStat($slug, $count)
    {
        Log::info("$slug, $count");
    }

    public function getDetailsAttribute($value)
    {
        return new Normalizer($value);
    }

    public function history()
    {
        return Archive::where('entity_type', get_class($this))->where('entity_id', $this->id)->get();
    }
}
