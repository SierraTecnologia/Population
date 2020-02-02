<?php

/**
 * This file is part of Gitonomy.
 *
 * (c) Alexandre Salomé <alexandre.salome@gmail.com>
 * (c) Julien DIDIER <genzo.wm@gmail.com>
 *
 * This source file is subject to the GPL license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Population\Models\Entytys\Digital\Bot;

use Informate\Traits\ComplexRelationamentTrait;
use Support\Models\Base;
use Finder\Actions\Action;
use Log;

class Runner extends Base
{
    use ComplexRelationamentTrait;

    protected $organizationPerspective = true;

    protected $table = 'bot_runners';

    protected $action = false;

    protected $target = false;

    protected $worker = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'action_code',
        'target_id',
        'progress',
        'task',
        'stage'
    ];

    public function usingAction(Action $action)
    {
        $this->action = $action;
        return $this;
    }

    public function usingTarget(Base $target)
    {
        $this->target = $target;
        return $this;
    }

    public function prepare()
    {
        return $this;
    }

    /**
     * 
     */
    public function execute()
    {
        if (!is_null($this->id)){
            $this->save();
        }

        if (!$this->action) {
            \Log::warning('[Estimate] Nenhuma ação para executar');
            return false;
        }
        
        $this->worker = $this->action->getClassWithParams($this->target);

        // dd($this->worker);
        $this->worker->execute();
        return $this;
    }

    public function run()
    {
        return $this->execute();
    }

}
