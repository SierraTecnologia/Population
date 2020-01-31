<?php

namespace Population\Manipule\Builders;

use App\Contants\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Expression;

/**
 * Class TagBuilder.
 *
 * @package Population\Manipule\Builders
 */
class TagBuilder extends Builder
{
    /**
     * @var string
     */
    private $tagsTable = Tables::TABLE_TAGS;

    /**
     * @var string
     */
    private $postsTagsTable = Tables::TABLE_POSTS_TAGS;

    /**
     * @return $this
     */
    public function defaultSelect()
    {
        return $this->select("{$this->tagsTable}.*");
    }

    /**
     * @return $this
     */
    public function whereHasPosts()
    {
        return $this->has('posts');
    }

    /**
     * @return $this
     */
    public function whereHasNoPosts()
    {
        return $this->doesntHave('posts');
    }

    /**
     * @return $this
     */
    public function orderByPopularity()
    {
        return $this
            ->addSelect(new Expression("COUNT({$this->postsTagsTable}.tag_id) AS popularity"))
            ->leftJoin($this->postsTagsTable, "{$this->postsTagsTable}.tag_id", '=', "{$this->tagsTable}.id")
            ->groupBy("{$this->tagsTable}.id")
            ->orderBy('popularity', 'desc');
    }
}
