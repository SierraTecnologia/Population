<?php

namespace Population\Manipule\Builders;

use App\Contants\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Expression;

/**
 * Class CommentBuilder.
 *
 * @package Population\Manipule\Builders
 */
class CommentBuilder extends Builder
{
    /**
     * @var string
     */
    private $commentsTable = Tables::TABLE_COMMENTS;

    /**
     * @var string
     */
    private $postsCommentsTable = Tables::TABLE_POSTS_COMMENTS;

    /**
     * @return $this
     */
    public function defaultSelect()
    {
        return $this->select("{$this->commentsTable}.*");
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
            ->addSelect(new Expression("COUNT({$this->postsCommentsTable}.comment_id) AS popularity"))
            ->leftJoin($this->postsCommentsTable, "{$this->postsCommentsTable}.comment_id", '=', "{$this->commentsTable}.id")
            ->groupBy("{$this->commentsTable}.id")
            ->orderBy('popularity', 'desc');
    }
}
