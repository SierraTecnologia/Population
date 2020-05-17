<?php

/**
 * @todo Mt bom, analisar
 */
namespace Population\Traits;

use InvalidArgumentException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Models\Routine;

trait HasRoutine
{
    protected $queuedRoutine = [];

    public static function getRoutineClassName(): string
    {
        return Routine::class;
    }

    public static function bootHasRoutine()
    {
        static::created(
            function (Model $routineableModel) {
                if (count($routineableModel->queuedRoutine) > 0) {
                    $routineableModel->attachRoutine($routineableModel->queuedRoutine);

                    $routineableModel->queuedRoutine = [];
                }
            }
        );

        static::deleted(
            function (Model $deletedModel) {
                $routines = $deletedModel->routines()->get();

                $deletedModel->detachRoutine($routines);
            }
        );
    }

    public function routines(): MorphToMany
    {
        return $this
            ->morphToMany(self::getRoutineClassName(), 'routineable')
            ->ordered();
    }

    /**
     * @param string $locale
     */
    public function routinesTranslated($locale = null): MorphToMany
    {
        $locale = ! is_null($locale) ? $locale : app()->getLocale();

        return $this
            ->morphToMany(self::getRoutineClassName(), 'routineable')
            ->select('*')
            ->selectRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.\"{$locale}\"')) as name_translated")
            ->selectRaw("JSON_UNQUOTE(JSON_EXTRACT(slug, '$.\"{$locale}\"')) as slug_translated")
            ->ordered();
    }

    /**
     * @param string|array|\ArrayAccess|\\App\Models\Routine $routines
     */
    public function setRoutineAttribute($routines)
    {
        if (! $this->exists) {
            $this->queuedRoutine = $routines;

            return;
        }

        $this->attachRoutine($routines);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder   $query
     * @param array|\ArrayAccess|\\App\Models\Routine $routines
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithAllRoutine(Builder $query, $routines, string $type = null): Builder
    {
        $routines = static::convertToRoutine($routines, $type);

        collect($routines)->each(
            function ($routine) use ($query) {
                $query->whereHas(
                    'routines', function (Builder $query) use ($routine) {
                        $query->where('routines.id', $routine ? $routine->id : 0);
                    }
                );
            }
        );

        return $query;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder   $query
     * @param array|\ArrayAccess|\\App\Models\Routine $routines
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithAnyRoutine(Builder $query, $routines, string $type = null): Builder
    {
        $routines = static::convertToRoutine($routines, $type);

        return $query->whereHas(
            'routines', function (Builder $query) use ($routines) {
                $routineIds = collect($routines)->pluck('id');

                $query->whereIn('routines.id', $routineIds);
            }
        );
    }

    public function scopeWithAllRoutineOfAnyType(Builder $query, $routines): Builder
    {
        $routines = static::convertToRoutineOfAnyType($routines);

        collect($routines)->each(
            function ($routine) use ($query) {
                $query->whereHas(
                    'routines', function (Builder $query) use ($routine) {
                        $query->where('routines.id', $routine ? $routine->id : 0);
                    }
                );
            }
        );

        return $query;
    }

    public function scopeWithAnyRoutineOfAnyType(Builder $query, $routines): Builder
    {
        $routines = static::convertToRoutineOfAnyType($routines);

        return $query->whereHas(
            'routines', function (Builder $query) use ($routines) {
                $routineIds = collect($routines)->pluck('id');

                $query->whereIn('routines.id', $routineIds);
            }
        );
    }

    public function routinesWithType(string $type = null): Collection
    {
        return $this->routines->filter(
            function (Routine $routine) use ($type) {
                return $routine->type === $type;
            }
        );
    }

    /**
     * @param array|\ArrayAccess|\\App\Models\Routine $routines
     *
     * @return $this
     */
    public function attachRoutine($routines)
    {
        $className = static::getRoutineClassName();

        $routines = collect($className::findOrCreate($routines));

        $this->routines()->syncWithoutDetaching($routines->pluck('id')->toArray());

        return $this;
    }

    /**
     * @param string|\\App\Models\Routine $routine
     *
     * @return $this
     */
    public function detachRoutine($routine)
    {
        return $this->detachRoutine([$routine]);
    }

    /**
     * @param array|\ArrayAccess $routines
     *
     * @return $this
     */
    public function syncRoutine($routines)
    {
        $className = static::getRoutineClassName();

        $routines = collect($className::findOrCreate($routines));

        $this->routines()->sync($routines->pluck('id')->toArray());

        return $this;
    }

    /**
     * @param array|\ArrayAccess $routines
     * @param string|null        $type
     *
     * @return $this
     */
    public function syncRoutineWithType($routines, string $type = null)
    {
        $className = static::getRoutineClassName();

        $routines = collect($className::findOrCreate($routines, $type));

        $this->syncRoutineIds($routines->pluck('id')->toArray(), $type);

        return $this;
    }

    protected static function convertToRoutine($values, $type = null, $locale = null)
    {
        return collect($values)->map(
            function ($value) use ($type, $locale) {
                if ($value instanceof Routine) {
                    if (isset($type) && $value->type != $type) {
                        throw new InvalidArgumentException("Type was set to {$type} but routine is of type {$value->type}");
                    }

                    return $value;
                }

                $className = static::getRoutineClassName();

                return $className::findFromString($value, $type, $locale);
            }
        );
    }

    protected static function convertToRoutineOfAnyType($values, $locale = null)
    {
        return collect($values)->map(
            function ($value) use ($locale) {
                if ($value instanceof Routine) {
                    return $value;
                }

                $className = static::getRoutineClassName();

                return $className::findFromStringOfAnyType($value, $locale);
            }
        );
    }

    /**
     * Use in place of eloquent's sync() method so that the routine type may be optionally specified.
     *
     * @param $ids
     * @param string|null $type
     * @param bool        $detaching
     */
    protected function syncRoutineIds($ids, string $type = null, $detaching = true)
    {
        $isUpdated = false;

        // Get a list of routine_ids for all current routines
        $current = $this->routines()
            ->newPivotStatement()
            ->where('routineable_id', $this->getKey())
            ->where('routineable_type', $this->getMorphClass())
            ->when(
                $type !== null, function ($query) use ($type) {
                    $routineModel = $this->routines()->getRelated();

                    return $query->join(
                        $routineModel->getTable(),
                        'routineables.routine_id',
                        '=',
                        $routineModel->getTable().'.'.$routineModel->getKeyName()
                    )
                        ->where('routines.type', $type);
                }
            )
            ->pluck('routine_id')
            ->all();

        // Compare to the list of ids given to find the routines to remove
        $detach = array_diff($current, $ids);
        if ($detaching && count($detach) > 0) {
            $this->routines()->detach($detach);
            $isUpdated = true;
        }

        // Attach any new ids
        $attach = array_diff($ids, $current);
        if (count($attach) > 0) {
            collect($attach)->each(
                function ($id) {
                    $this->routines()->attach($id, []);
                }
            );
            $isUpdated = true;
        }

        // Once we have finished attaching or detaching the records, we will see if we
        // have done any attaching or detaching, and if we have we will touch these
        // relationships if they are configured to touch on any database updates.
        if ($isUpdated) {
            $this->routines()->touchIfTouching();
        }
    }
}
