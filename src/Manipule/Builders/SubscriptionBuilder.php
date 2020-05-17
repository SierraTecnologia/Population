<?php

namespace Population\Manipule\Builders;

use App\Contants\Tables;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class SubscriptionBuilder.
 *
 * @package Population\Manipule\Builders
 */
class SubscriptionBuilder extends Builder
{
    /**
     * @var string
     */
    private $subscriptionsTable = Tables::TABLE_SUBSCRIPTIONS;

    /**
     * @param  string $ids
     * @return $this
     */
    public function whereIds(string $ids)
    {
        return $this->whereIn("{$this->subscriptionsTable}.id", explode(',', $ids));
    }

    /**
     * @param  string $email
     * @return $this
     */
    public function whereEmailLike(string $email)
    {
        return $this->where("{$this->subscriptionsTable}.email", 'like', $email);
    }

    /**
     * @param  array $emails
     * @return $this
     */
    public function whereEmailIn(array $emails)
    {
        return $this->whereIn("{$this->subscriptionsTable}.email", $emails);
    }

    /**
     * @param  string $token
     * @return $this
     */
    public function whereTokenEquals(string $token)
    {
        return $this->where("{$this->subscriptionsTable}.token", $token);
    }
}
