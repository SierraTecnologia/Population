<?php

namespace Population\Models\Entytys\Digital\Midia;

use Population\Manipule\Builders\ThumbnailBuilder;
use Population\Manipule\Entities\ThumbnailEntity;
use Support\Models\Base;

/**
 * Class Thumbnail.
 *
 * @property int id
 * @property string path
 * @property int width
 * @property int height
 * @package App\Models
 */
class Thumbnail extends Base
{
    /**
     * @inheritdoc
     */
    public $timestamps = false;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'path',
        'width',
        'height',
    ];

    /**
     * @inheritdoc
     */
    public function newEloquentBuilder($query): ThumbnailBuilder
    {
        return new ThumbnailBuilder($query);
    }

    /**
     * @inheritdoc
     */
    public function newQuery(): ThumbnailBuilder
    {
        return parent::newQuery();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function photos()
    {
        return $this->belongsToMany(Photo::class, 'photos_thumbnails');
    }

    /**
     * @return ThumbnailEntity
     */
    public function toEntity(): ThumbnailEntity
    {
        return new ThumbnailEntity([
            'path' => $this->path,
            'width' => $this->width,
            'height' => $this->height,
        ]);
    }
}
