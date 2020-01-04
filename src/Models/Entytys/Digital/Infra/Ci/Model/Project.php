<?php

namespace SiUtils\Tools\Model;

use SiUtils\Tools\Store\Factory;
use SiUtils\Tools\Store\EnvironmentStore;
use SiUtils\Tools\Store\ProjectGroupStore;
use Symfony\Component\Yaml\Parser as YamlParser;
use Symfony\Component\Yaml\Dumper as YamlDumper;
use Population\Models\Entytys\Digital\Infra\Ci\Base\Project as BaseProject;

/**
 * @author Ricardo Sierra <ricardo@sierratecnologia.com>
 */
class Project extends BaseProject
{
    /**
     * @return ProjectGroup|null
     */
    public function getGroup()
    {
        $groupId = $this->getGroupId();
        if (empty($groupId)) {
            return null;
        }

        /** @var ProjectGroupStore $groupStore */
        $groupStore = Factory::getStore('ProjectGroup');

        return $groupStore->getById($groupId);
    }

    /**
     * Get Build models by ProjectId for this Project.
     *
     * @return \PHPCensor\Model\Build[]
     */
    public function getProjectBuilds()
    {
        return Factory::getStore('Build')->getByProjectId($this->getId());
    }

    /**
     * Return the latest build from a specific branch, of a specific status, for this project.
     *
     * @param string $branch
     * @param null   $status
     *
     * @return mixed|null
     */
    public function getLatestBuild($branch = 'master', $status = null)
    {
        $criteria = ['branch' => $branch, 'project_id' => $this->getId()];

        if (isset($status)) {
            $criteria['status'] = $status;
        }

        $order  = ['id' => 'DESC'];
        $builds = Factory::getStore('Build')->getWhere($criteria, 1, 0, $order);

        if (is_array($builds['items']) && count($builds['items'])) {
            $latest = array_shift($builds['items']);

            if (isset($latest) && $latest instanceof Build) {
                return $latest;
            }
        }

        return null;
    }

    /**
     * Return the previous build from a specific branch, for this project.
     *
     * @param string $branch
     *
     * @return mixed|null
     */
    public function getPreviousBuild($branch = 'master')
    {
        $criteria = ['branch' => $branch, 'project_id' => $this->getId()];
        $order    = ['id' => 'DESC'];
        $builds   = Factory::getStore('Build')->getWhere($criteria, 1, 1, $order);

        if (is_array($builds['items']) && count($builds['items'])) {
            $previous = array_shift($builds['items']);

            if (isset($previous) && $previous instanceof Build) {
                return $previous;
            }
        }

        return null;
    }

    /**
     * Return the name of a FontAwesome icon to represent this project, depending on its type.
     *
     * @return string
     */
    public function getIcon()
    {
        switch ($this->getType()) {
            case Project::TYPE_GITHUB:
                $icon = 'github';
                break;

            case Project::TYPE_BITBUCKET:
            case Project::TYPE_BITBUCKET_HG:
            case Project::TYPE_BITBUCKET_SERVER:
                $icon = 'bitbucket';
                break;

            case Project::TYPE_GIT:
            case Project::TYPE_GITLAB:
            case Project::TYPE_GOGS:
            case Project::TYPE_HG:
            case Project::TYPE_SVN:
            default:
                $icon = 'code-fork';
                break;
        }

        return $icon;
    }

    /**
     * @return EnvironmentStore
     */
    protected function getEnvironmentStore()
    {
        /** @var EnvironmentStore $store */
        $store = Factory::getStore('Environment');
        return $store;
    }

    /**
     * Get Environments
     *
     * @return array contain items with \PHPCensor\Model\Environment
     */
    public function getEnvironmentsObjects()
    {
        $projectId = $this->getId();

        if (empty($projectId)) {
            return null;
        }

        return $this->getEnvironmentStore()->getByProjectId($projectId);
    }

    /**
     * Get Environments
     *
     * @return string[]
     */
    public function getEnvironmentsNames()
    {
        $environments      = $this->getEnvironmentsObjects();
        $environmentsNames = [];
        foreach ($environments['items'] as $environment) {
            /** @var Environment $environment */
            $environmentsNames[] = $environment->getName();
        }

        return $environmentsNames;
    }

    /**
     * Get Environments
     *
     * @return string yaml
     */
    public function getEnvironments()
    {
        $environments       = $this->getEnvironmentsObjects();
        $environmentsConfig = [];
        foreach ($environments['items'] as $environment) {
            /** @var Environment $environment */
            $environmentsConfig[$environment->getName()] = $environment->getBranches();
        }

        $yamlDumper = new YamlDumper();
        $value      = $yamlDumper->dump($environmentsConfig, 10, 0, true, false);

        return $value;
    }

    /**
     * Set Environments
     *
     * @param string $value yaml
     */
    public function setEnvironments($value)
    {
        $yamlParser          = new YamlParser();
        $environmentsConfig  = $yamlParser->parse($value);
        $environmentsNames   = !empty($environmentsConfig) ? array_keys($environmentsConfig) : [];
        $currentEnvironments = $this->getEnvironmentsObjects();
        $store               = $this->getEnvironmentStore();
        foreach ($currentEnvironments['items'] as $environment) {
            /** @var Environment $environment */
            $key = array_search($environment->getName(), $environmentsNames);
            if ($key !== false) {
                // already exist
                unset($environmentsNames[$key]);
                $environment->setBranches(!empty($environmentsConfig[$environment->getName()]) ? $environmentsConfig[$environment->getName()] : []);
                $store->save($environment);
            } else {
                // remove
                $store->delete($environment);
            }
        }

        if (!empty($environmentsNames)) {
            // add
            foreach ($environmentsNames as $environmentName) {
                $environment = new Environment();
                $environment->setProjectId($this->getId());
                $environment->setName($environmentName);
                $environment->setBranches(!empty($environmentsConfig[$environment->getName()]) ? $environmentsConfig[$environment->getName()] : []);
                $store->save($environment);
            }
        }
    }

    /**
     * @param string $branch
     *
     * @return string[]
     */
    public function getEnvironmentsNamesByBranch($branch)
    {
        $environmentsNames = [];
        $environments      = $this->getEnvironmentsObjects();
        $defaultBranch     = ($branch == $this->getBranch());
        foreach ($environments['items'] as $environment) {
            /** @var Environment $environment */
            if ($defaultBranch || in_array($branch, $environment->getBranches())) {
                $environmentsNames[] = $environment->getName();
            }
        }

        return $environmentsNames;
    }

    /**
     * @param string $environmentName
     *
     * @return string[]
     */
    public function getBranchesByEnvironment($environmentName)
    {
        $branches     = [];
        $environments = $this->getEnvironmentsObjects();
        foreach ($environments['items'] as $environment) {
            /** @var Environment $environment */
            if ($environmentName == $environment->getName()) {
                return $environment->getBranches();
            }
        }

        return $branches;
    }
}
