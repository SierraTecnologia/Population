<?php

namespace Population\Manipule\Builders;

use App\Contants\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Expression;

/**
 * Class NotificationBuilder.
 *
 * @package Population\Manipule\Builders
 */
class NotificationBuilder extends Builder
{
    /**
     * @var string
     */
    private $notificationsTable = Tables::TABLE_NOTIFICATIONS;

    /**
     * @var string
     */
    private $postsNotificationsTable = Tables::TABLE_POSTS_NOTIFICATIONS;

    /**
     * @return $this
     */
    public function defaultSelect()
    {
        return $this->select("{$this->notificationsTable}.*");
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
            ->addSelect(new Expression("COUNT({$this->postsNotificationsTable}.notification_id) AS popularity"))
            ->leftJoin($this->postsNotificationsTable, "{$this->postsNotificationsTable}.notification_id", '=', "{$this->notificationsTable}.id")
            ->groupBy("{$this->notificationsTable}.id")
            ->orderBy('popularity', 'desc');
    }
}
