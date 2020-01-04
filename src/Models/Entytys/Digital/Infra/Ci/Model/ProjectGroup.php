<?php

namespace SiUtils\Tools\Model;

use SiUtils\Tools\Store\Factory;
use Population\Models\Entytys\Digital\Infra\Ci\Base\ProjectGroup as BaseProjectGroup;
use SiUtils\Tools\Store\ProjectStore;

class ProjectGroup extends BaseProjectGroup
{
    /**
     * @return Project[]
     */
    public function getGroupProjects()
    {
        /** @var ProjectStore $projectStore */
        $projectStore = Factory::getStore('Project');

        return $projectStore->getByGroupId($this->getId(), false);
    }
}
