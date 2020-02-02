<?php

namespace Population\Manipule\Builders;

use Finder\Models\Digital\Midia\Photo;
use App\Contants\Tables;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class PhotoBuilder.
 *
 * @package Population\Manipule\Builders
 */
class PhotoBuilder extends Builder
{
    /**
     * @var string
     */
    private $photosTable = 'photos';

    /**
     * @return $this
     */
    public function defaultSelect()
    {
        return $this->select("{$this->photosTable}.*");
    }

    /**
     * @return $this
     */
    public function withEntityRelations()
    {
        return $this->with(Photo::$entityRelations);
    }

    /**
     * @param int $id
     * @return $this
     */
    public function whereIdEquals(int $id)
    {
        return $this->where("{$this->photosTable}.id", $id);
    }

    /**
     * @param int $createdByUserId
     * @return $this
     */
    public function whereCreatedByUserIdEquals(int $createdByUserId)
    {
        return $this->where("{$this->photosTable}.created_by_user_id", $createdByUserId);
    }

    /**
     * @param Carbon $date
     * @return $this
     */
    public function whereCreatedAtLessThan(Carbon $date)
    {
        return $this->where("{$this->photosTable}.created_at", '<', $date);
    }

    /**
     * @return $this
     */
    public function whereHasNoPosts()
    {
        return $this->doesntHave('posts');
    }

    /**
     * @param Carbon $date
     * @return $this
     */
    public function whereUpdatedAtLessThan(Carbon $date)
    {
        return $this->where("{$this->photosTable}.updated_at", '<', $date);
    }
}
