<?php
/**
 * Rotinas de Inclusão de Dados
 */

namespace SiFinder\Logic\Events;

use SiFinder\Models\Entytys\Digital\Code\Commit;
use SiFinder\Models\Entytys\Digital\Infra\Pipeline;

class NewCommit
{
    public function __construct(Commit $commit)
    {

        // $pipeline = Pipeline::create([

        // ]);

        // Analisa o Commit

        $analyser = $commit;
    }
}
