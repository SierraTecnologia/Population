<?php

namespace Population\Models\Entytys\Digital\Code;

use Doctrine\Common\Collections\ArrayCollection;
use SiUtils\Tools\Programs\Git\Repository;

use Support\Models\Base;
use SiUtils\Helper\General;

class Project extends Base
{

    public static $apresentationName = 'Projetos';

    const SLUG_PATTERN = '[a-zA-Z0-9-_]+';

    protected $repositorySize;
    protected $userRoles;
    protected $gitAccesses;
    protected $feeds;
    protected $defaultBranch = 'master';

    protected $table = 'project'; //'code_projects'; // Deixando igual ao playground

    protected $organizationPerspective = true;

    // const CREATED_AT = 'dateCreated';
    // const UPDATED_AT = 'dateModified';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'url',
        'status',
        'repository',
        'code_language_id',
        'subtype',
        'projectPath',
        'projectDepth',
        'projectPathKey',
    ];

    public function getApresentationName()
    {
        return $this->slug.' - '.$this->name;
    }

    // public function __construct($name = null, $slug = null)
    // {
    //     if ($name) {
    //         $this->name = $name;
    //     }
    //     if ($slug) {
    //         $this->slug = $slug;
    //     }
    //     $this->userRoles   = new ArrayCollection();
    //     $this->gitAccesses = new ArrayCollection();
    // }

    /**
     * Returns the user role of a given user.
     *
     * @return UserRoleProject The user role on the project
     *
     * @throws InvalidArgumentException Throws an exception if no role was found for the given user on the project.
     */
    public function getUserRole(User $user)
    {
        foreach ($this->userRoles as $userRole) {
            if ($user->equals($userRole->getUser())) {
                return $userRole;
            }
        }

        return null;
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            // todo Observer 
            $model->dateCreated = time();
            $model->dateModified = time();

            if (empty($model->status)){
                $model->status = '0';
            }

            if (empty($model->viewPolicy)){
                $model->viewPolicy = 'public';
            }
            if (empty($model->editPolicy)){
                $model->editPolicy = 'public';
            }
            if (empty($model->joinPolicy)){
                $model->joinPolicy = 'public';
            }
            if (empty($model->icon)){
                $model->icon = 'money';
            }
            if (empty($model->color)){
                $model->color = 'blue';
            }
            if (empty($model->mailKey)){
                $model->mailKey = 'sierra.csi@gmail.com';
            }

            if (empty($model->hasWorkboard)){
                $model->hasWorkboard = '0';
            }
            if (empty($model->hasMilestones)){
                $model->hasMilestones = '0';
            }
            if (empty($model->hasSubprojects)){
                $model->hasSubprojects = '0';
            }
            if (empty($model->properties)){
                $model->properties = $model->name;
            }
            if (empty($model->subtype)){
                $model->subtype = $model->name;
            }

            if (empty($model->projectPath)){
                $model->projectPath = $model->name;
            }
            if (empty($model->projectDepth)){
                $model->projectDepth = 1;
            }
            if (empty($model->projectPathKey)){
                $model->projectPathKey = substr($model->name, 0, 4);
            }


            $model->phid = General::generateToken();
            $model->authorPHID = 1;
        });
    }

    public function getUsers()
    {
        $result = array();
        foreach ($this->userRoles as $userRole) {
            $result[] = $userRole->getUser();
        }

        return $result;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getRepositorySize()
    {
        return $this->repositorySize;
    }

    public function setRepositorySize($repositorySize)
    {
        $this->repositorySize = $repositorySize;
    }

    public function getUserRoles()
    {
        return $this->userRoles;
    }

    public function getGitAccesses()
    {
        return $this->gitAccesses;
    }

    public function getDefaultBranch()
    {
        return $this->defaultBranch;
    }

    public function setDefaultBranch($defaultBranch)
    {
        $this->defaultBranch = $defaultBranch;
    }

    public function getFeeds()
    {
        return $this->feeds;
    }

    public function setFeeds($feeds)
    {
        $this->feeds = $feeds;
    }

    public function getRepositoryPath()
    {
        if (!$this->hasRepository()) {
            return false;
        }

        return storage_path().DIRECTORY_SEPARATOR.'repo'.DIRECTORY_SEPARATOR.md5($this->getRepository());
    }

    public function repositoryIsCloned()
    {
        if (file_exists($this->getRepositoryPath())) {
            return true;
        }
        return false;
    }

    public function getRepository()
    {
        if (!$this->hasRepository()) {
            throw new \LogicException("No repository injected in project");
        }

        return $this->repository;
    }

    public function setRepository(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function hasRepository()
    {
        if (empty($this->repository)) {
            return false;
        }
        return null !== $this->repository;
    }

    public function isEmpty()
    {
        try {
            return !$this->getRepository()->getReferences()->hasBranches();
        } catch (\LogicException $e) {
            throw new \RuntimeException('Unable to determine if repository is empty', null, $e);
        }
    }
}

