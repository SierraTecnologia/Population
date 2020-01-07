<?php

namespace Population\Models\Actions;

use SiObjects\Manipule\Builders\QuestionBuilder;
use Siravel\Contants\Tables;
use Population\Entities\QuestionEntity;
use Illuminate\Database\Eloquent\Collection;
use Support\Models\Base;
use TCG\Voyager\Models\Post;

/**
 * Class Question.
 *
 * @property int id
 * @property string value
 * @property Collection responses
 * @package App\Models
 */
class Question extends Base
{
    /**
     * @inheritdoc
     */
    public $timestamps = false;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        // Pergunta a ser Feita
        'question',

        // Tipo de Pergunta
        // Ex: seguranca, espectativa, gosto, 
        'type',

        // Tipo de Resposta
        // text, bool, input
        'options',

        'perpective',
        'perpective_reference',

        'relation',
    ];

    /**
     * Retorna Todos os Requisitos para que essa Pergunta possa ser feita!
     */
    public function requisitos()
    {
        return $this->belongsToMany(Post::class, Tables::TABLE_POSTS_TAGS);
    }

    /**
     * Retorna o Skill e um Numero entre 0 e 1 para esse Video
     */
    public function skills()
    {
        return $this->belongsToMany(Post::class, Tables::TABLE_POSTS_TAGS);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function responses()
    {
        return $this->belongsToMany(Post::class, Tables::TABLE_POSTS_TAGS);
    }

    /**
     * @inheritdoc
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function (self $question) {
            $question->responses()->detach();
        });
    }

    /**
     * @inheritdoc
     */
    public function newEloquentBuilder($query): QuestionBuilder
    {
        return new QuestionBuilder($query);
    }

    /**
     * @inheritdoc
     */
    public function newQuery(): QuestionBuilder
    {
        return parent::newQuery();
    }

    /**
     * Setter for the 'value' attribute.
     *
     * @param string $value
     * @return $this
     */
    public function setValueAttribute(string $value)
    {
        $this->attributes['value'] = trim(str_replace(' ', '_', strtolower($value)));

        return $this;
    }

    /**
     * @return QuestionEntity
     */
    public function toEntity(): QuestionEntity
    {
        return new QuestionEntity([
            'id' => $this->id,
            'value' => $this->value,
        ]);
    }
}
