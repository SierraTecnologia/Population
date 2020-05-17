<?php

namespace Population\Manipule\Managers\Tag;

use App\Models\Tag;
use Population\Manipule\Managers\TagManager;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\ConnectionInterface as Database;

/**
 * Class ARTagManager.
 *
 * @package Population\Manipule\Managers\Tag
 */
class ARTagManager implements TagManager
{
    /**
     * @var Database
     */
    private $database;

    /**
     * TagManager constructor.
     *
     * @param Database $database
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @inheritdoc
     */
    public function paginate(int $page, int $perPage, array $filters = []): LengthAwarePaginator
    {
        $query = (new Tag)
            ->newQuery()
            ->defaultSelect()
            ->orderByPopularity();

        $paginator = $query->paginate($perPage, ['*'], 'page', $page)->appends($filters);

        $paginator->getCollection()->transform(
            function (Tag $tag) {
                return $tag->toEntity();
            }
        );

        return $paginator;
    }
}
