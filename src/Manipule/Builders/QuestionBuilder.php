<?php
/**
 * @todo Fazer essa classe aqui
 */

namespace Population\Manipule\Builders;

use App\Models\Question;
use App\Contants\Tables;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class QuestionBuilder.
 *
 * @package Population\Manipule\Builders
 */
class QuestionBuilder extends Builder
{
    /**
     * @var string
     */
    private $postsTable = Tables::TABLE_POSTS;
    /**
     * @var string
     */
    private $tagsTable = Tables::TABLE_TAGS;

    /**
     * @return $this
     */
    public function withEntityRelations()
    {
        return $this->with(Question::$entityRelations);
    }

    /**
     * @param int $id
     * @return $this
     */
    public function whereIdLessThan(int $id)
    {
        return $this->where("{$this->postsTable}.id", '<', $id);
    }

    /**
     * @param int $id
     * @return $this
     */
    public function whereIdGreaterThan(int $id)
    {
        return $this->where("{$this->postsTable}.id", '>', $id);
    }

    /**
     * @return $this
     */
    public function whereIsPublished()
    {
        return $this->whereNotNull("{$this->postsTable}.published_at");
    }

    /**
     * @return $this
     */
    public function whereIsNotPublished()
    {
        return $this->whereNull("{$this->postsTable}.published_at");
    }

    /**
     * @param Carbon $date
     * @return $this
     */
    public function wherePublishedAtGreaterThanOrEqualTo(Carbon $date)
    {
        return $this->where("{$this->postsTable}.published_at", '>=', $date);
    }

    /**
     * @param string $tagValue
     * @return $this
     */
    public function whereTagValueEquals(string $tagValue)
    {
        return $this->whereHas('tags', function (Builder $query) use ($tagValue) {
            $query->where("{$this->tagsTable}.value", $tagValue);
        });
    }

    /**
     * @param string $searchPhrase
     * @return $this
     */
    public function searchByPhrase(string $searchPhrase)
    {
        $whereSearchPhraseScope = function (Builder $query, string $searchPhrase) {
            $query
                ->where("{$this->postsTable}.description", 'like', "%{$searchPhrase}%")
                ->orWhereHas('tags', function (Builder $query) use ($searchPhrase) {
                    $query->where("{$this->tagsTable}.value", 'like', "%{$searchPhrase}%");
                });
        };

        return $this->where(function (Builder $query) use ($whereSearchPhraseScope, $searchPhrase) {
            // Search by whole search phrase.
            $query->where(function (Builder $query) use ($whereSearchPhraseScope, $searchPhrase) {
                $whereSearchPhraseScope($query, $searchPhrase);
            });

            $searchPhraseWords = explode(' ', $searchPhrase);
            if (count($searchPhraseWords) > 1) {
                $query->orWhere(function (Builder $query) use ($whereSearchPhraseScope, $searchPhraseWords) {
                    // Search by each search phrase word separately.
                    foreach ($searchPhraseWords as $searchPhrase) {
                        $query->where(function (Builder $query) use ($whereSearchPhraseScope, $searchPhrase) {
                            $whereSearchPhraseScope($query, $searchPhrase);
                        });
                    }
                });
            }
        });
    }

    /**
     * @return $this
     */
    public function orderByCreatedAtDesc()
    {
        return $this->orderBy("{$this->postsTable}.created_at", 'desc');
    }

    /**
     * @return $this
     */
    public function orderByIdAsc()
    {
        return $this->orderBy("{$this->postsTable}.id", 'asc');
    }

    /**
     * @return $this
     */
    public function orderByIdDesc()
    {
        return $this->orderBy("{$this->postsTable}.id", 'desc');
    }
}
