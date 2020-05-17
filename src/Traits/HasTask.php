<?php

namespace Population\Traits;

use InvalidArgumentException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Models\Routine;

trait HasTask
{
    protected $queuedTask = [];

    public static function getTaskClassName(): string
    {
        return Task::class;
    }

    public static function bootHasTask()
    {
        static::created(
            function (Model $taskableModel) {
                if (count($taskableModel->queuedTask) > 0) {
                    $taskableModel->attachTask($taskableModel->queuedTask);

                    $taskableModel->queuedTask = [];
                }
            }
        );

        static::deleted(
            function (Model $deletedModel) {
                $tasks = $deletedModel->tasks()->get();

                $deletedModel->detachTask($tasks);
            }
        );
    }

    public function tasks(): MorphToMany
    {
        return $this
            ->morphToMany(self::getTaskClassName(), 'taskable')
            ->ordered();
    }

    /**
     * @param string $locale
     */
    public function tasksTranslated($locale = null): MorphToMany
    {
        $locale = ! is_null($locale) ? $locale : app()->getLocale();

        return $this
            ->morphToMany(self::getTaskClassName(), 'taskable')
            ->select('*')
            ->selectRaw("JSON_UNQUOTE(JSON_EXTRACT(name, '$.\"{$locale}\"')) as name_translated")
            ->selectRaw("JSON_UNQUOTE(JSON_EXTRACT(slug, '$.\"{$locale}\"')) as slug_translated")
            ->ordered();
    }

    /**
     * @param string|array|\ArrayAccess|\\App\Models\Task $tasks
     */
    public function setTaskAttribute($tasks)
    {
        if (! $this->exists) {
            $this->queuedTask = $tasks;

            return;
        }

        $this->attachTask($tasks);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array|\ArrayAccess|\\App\Models\Task  $tasks
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithAllTask(Builder $query, $tasks, string $type = null): Builder
    {
        $tasks = static::convertToTask($tasks, $type);

        collect($tasks)->each(
            function ($task) use ($query) {
                $query->whereHas(
                    'tasks', function (Builder $query) use ($task) {
                        $query->where('tasks.id', $task ? $task->id : 0);
                    }
                );
            }
        );

        return $query;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array|\ArrayAccess|\\App\Models\Task  $tasks
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithAnyTask(Builder $query, $tasks, string $type = null): Builder
    {
        $tasks = static::convertToTask($tasks, $type);

        return $query->whereHas(
            'tasks', function (Builder $query) use ($tasks) {
                $taskIds = collect($tasks)->pluck('id');

                $query->whereIn('tasks.id', $taskIds);
            }
        );
    }

    public function scopeWithAllTaskOfAnyType(Builder $query, $tasks): Builder
    {
        $tasks = static::convertToTaskOfAnyType($tasks);

        collect($tasks)->each(
            function ($task) use ($query) {
                $query->whereHas(
                    'tasks', function (Builder $query) use ($task) {
                        $query->where('tasks.id', $task ? $task->id : 0);
                    }
                );
            }
        );

        return $query;
    }

    public function scopeWithAnyTaskOfAnyType(Builder $query, $tasks): Builder
    {
        $tasks = static::convertToTaskOfAnyType($tasks);

        return $query->whereHas(
            'tasks', function (Builder $query) use ($tasks) {
                $taskIds = collect($tasks)->pluck('id');

                $query->whereIn('tasks.id', $taskIds);
            }
        );
    }

    public function tasksWithType(string $type = null): Collection
    {
        return $this->tasks->filter(
            function (Task $task) use ($type) {
                return $task->type === $type;
            }
        );
    }

    /**
     * @param array|\ArrayAccess|\\App\Models\Task $tasks
     *
     * @return $this
     */
    public function attachTask($tasks)
    {
        $className = static::getTaskClassName();

        $tasks = collect($className::findOrCreate($tasks));

        $this->tasks()->syncWithoutDetaching($tasks->pluck('id')->toArray());

        return $this;
    }

    /**
     * @param array|\ArrayAccess $tasks
     *
     * @return $this
     */
    public function detachTask($tasks)
    {
        $tasks = static::convertToTask($tasks);

        collect($tasks)
            ->filter()
            ->each(
                function (Task $task) {
                    $this->tasks()->detach($task);
                }
            );

        return $this;
    }

    /**
     * @param array|\ArrayAccess $tasks
     *
     * @return $this
     */
    public function syncTask($tasks)
    {
        $className = static::getTaskClassName();

        $tasks = collect($className::findOrCreate($tasks));

        $this->tasks()->sync($tasks->pluck('id')->toArray());

        return $this;
    }

    /**
     * @param array|\ArrayAccess $tasks
     * @param string|null        $type
     *
     * @return $this
     */
    public function syncTaskWithType($tasks, string $type = null)
    {
        $className = static::getTaskClassName();

        $tasks = collect($className::findOrCreate($tasks, $type));

        $this->syncTaskIds($tasks->pluck('id')->toArray(), $type);

        return $this;
    }

    protected static function convertToTask($values, $type = null, $locale = null)
    {
        return collect($values)->map(
            function ($value) use ($type, $locale) {
                if ($value instanceof Task) {
                    if (isset($type) && $value->type != $type) {
                        throw new InvalidArgumentException("Type was set to {$type} but task is of type {$value->type}");
                    }

                    return $value;
                }

                $className = static::getTaskClassName();

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
     * Use in place of eloquent's sync() method so that the task type may be optionally specified.
     *
     * @param $ids
     * @param string|null $type
     * @param bool        $detaching
     */
    protected function syncRoutineIds($ids, string $type = null, $detaching = true)
    {
        $isUpdated = false;

        // Get a list of task_ids for all current tasks
        $current = $this->tasks()
            ->newPivotStatement()
            ->where('taskable_id', $this->getKey())
            ->where('taskable_type', $this->getMorphClass())
            ->when(
                $type !== null, function ($query) use ($type) {
                    $taskModel = $this->tasks()->getRelated();

                    return $query->join(
                        $taskModel->getTable(),
                        'taskables.task_id',
                        '=',
                        $taskModel->getTable().'.'.$taskModel->getKeyName()
                    )
                        ->where('tasks.type', $type);
                }
            )
            ->pluck('task_id')
            ->all();

        // Compare to the list of ids given to find the tasks to remove
        $detach = array_diff($current, $ids);
        if ($detaching && count($detach) > 0) {
            $this->tasks()->detach($detach);
            $isUpdated = true;
        }

        // Attach any new ids
        $attach = array_diff($ids, $current);
        if (count($attach) > 0) {
            collect($attach)->each(
                function ($id) {
                    $this->tasks()->attach($id, []);
                }
            );
            $isUpdated = true;
        }

        // Once we have finished attaching or detaching the records, we will see if we
        // have done any attaching or detaching, and if we have we will touch these
        // relationships if they are configured to touch on any database updates.
        if ($isUpdated) {
            $this->tasks()->touchIfTouching();
        }
    }
}
