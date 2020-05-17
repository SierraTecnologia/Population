<?php

namespace Population\Manipule\Builders;

use App\Contants\Tables;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class UserBuilder.
 *
 * @package Population\Manipule\Builders
 */
class UserBuilder extends Builder
{
    /**
     * @var string
     */
    private $usersTable = Tables::TABLE_USERS;

    /**
     * @return $this
     */
    public function defaultSelect()
    {
        return $this->select("{$this->usersTable}.*");
    }

    /**
     * @param  int $id
     * @return $this
     */
    public function whereIdEquals(int $id)
    {
        return $this->where("{$this->usersTable}.id", $id);
    }

    /**
     * @param  string $name
     * @return $this
     */
    public function whereNameEquals(string $name)
    {
        return $this->where("{$this->usersTable}.name", $name);
    }

    /**
     * @param  string $email
     * @return $this
     */
    public function whereEmailEquals(string $email)
    {
        return $this->where("{$this->usersTable}.email", $email);
    }
}
