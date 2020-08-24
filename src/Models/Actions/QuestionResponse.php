<?php

namespace Population\Models\Actions;

use Population\Manipule\Builders\QuestionResponseBuilder;
use App\Contants\Tables;
use Population\Manipule\Entities\QuestionResponseEntity;
use Illuminate\Database\Eloquent\Collection;
use Support\Models\Base;
use Siravel\Models\Blog\Post;

/**
 * Class QuestionResponse.
 *
 * @property int id
 * @property string value
 * @property Collection responses
 * @package  App\Models
 */
class QuestionResponse extends Base
{
    public static $classeBuilder = QuestionResponseBuilder::class;

    /**
     * @inheritdoc
     */
    public $timestamps = false;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'question_id',
        'user_id',
    ];

    /**
     * @inheritdoc
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(
            function (self $question) {
                $question->responses()->detach();
            }
        );
    }

    /**
     * @inheritdoc
     */
    public function newEloquentBuilder($query): QuestionResponseBuilder
    {
        return new QuestionResponseBuilder($query);
    }

    /**
     * @inheritdoc
     */
    public function newQuery(): QuestionResponseBuilder
    {
        return parent::newQuery();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function responses()
    {
        return $this->belongsToMany(Post::class, Tables::TABLE_POSTS_TAGS);
    }

    /**
     * Setter for the 'value' attribute.
     *
     * @param  string $value
     * @return $this
     */
    public function setValueAttribute(string $value)
    {
        $this->attributes['value'] = trim(str_replace(' ', '_', strtolower($value)));

        return $this;
    }

    /**
     * @return QuestionResponseEntity
     */
    public function toEntity(): QuestionResponseEntity
    {
        return new QuestionResponseEntity(
            [
            'id' => $this->id,
            'value' => $this->value,
            ]
        );
    }
}
