<?php

namespace Population\Models\Identity\Location;

use Population\Manipule\Builders\LocationBuilder;
use Siravel\Contants\Tables;
use Population\Manipule\Entities\LocationEntity;
use Population\Manipule\ValueObjects\Coordinates;
use Population\Manipule\ValueObjects\Latitude;
use Population\Manipule\ValueObjects\Longitude;
use Support\Models\Base;
use Illuminate\Support\Str;

use Finder\Models\Digital\Midia\Photo;

/**
 * Class Location.
 *
 * Note: Laravel does not support spatial types.
 * See: https://dev.mysql.com/doc/refman/5.7/en/spatial-type-overview.html
 *
 * @property int id
 * @property Coordinates coordinates
 * @package App\Models
 */
class Location extends Base
{
    /**
     * @inheritdoc
     */
    public $timestamps = false;

    /**
     * @inheritdoc
     */
    protected $table = Tables::TABLE_LOCATIONS;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'coordinates',
    ];

    /**
     * @inheritdoc
     */
    public function newEloquentBuilder($query): LocationBuilder
    {
        return (new LocationBuilder($query))->defaultSelect();
    }

    /**
     * @inheritdoc
     */
    public function newQuery(): LocationBuilder
    {
        return parent::newQuery();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany(Photo::class, 'location_id');
    }

    /**
     * @param Coordinates $coordinates
     * @return $this
     */
    public function setCoordinatesAttribute(Coordinates $coordinates)
    {
        $expression = "ST_GeomFromText('POINT({$coordinates})')";

        $this->attributes['coordinates'] = $this->getConnection()->raw($expression);

        return $this;
    }

    /**
     * @return Coordinates|null
     */
    public function getCoordinatesAttribute() //: Coordinates
    {
        if (!isset($this->attributes['coordinates'])) {
            return null;
        }
        $raw = Str::before(Str::after($this->attributes['coordinates'], 'POINT('), ')');

        [$latitude, $longitude] = explode(' ', $raw);

        return new Coordinates(new Latitude($latitude), new Longitude($longitude));
    }

    /**
     * @return LocationEntity
     */
    public function toEntity(): LocationEntity
    {
        return new LocationEntity([
            'id' => $this->id,
            'coordinates' => $this->coordinates->toArray(),
        ]);
    }
}
