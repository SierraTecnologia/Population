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

namespace Population\Models\Entytys\Digital\Code\Repository;

use Doctrine\ORM\EntityRepository;

use Population\Models\Entytys\Digital\Code\Project;
use Population\Models\Entytys\Digital\Code\Feed;

/**
 * @author Julien DIDIER <genzo.wm@gmail.com>
 */
class FeedRepository extends EntityRepository
{
    public function findOneOrCreate(Project $project, $reference)
    {
        try {
            $thread = $this->findOneBy(array(
                'project'   => $project,
                'reference' => $reference
            ));
        } catch (\Exception $e) {
            throw $e;
        }
        if (null === $thread) {
            $thread = new Feed($project, $reference);
        }

        return $thread;
    }
}
