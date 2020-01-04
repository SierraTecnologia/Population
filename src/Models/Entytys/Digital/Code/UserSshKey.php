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

namespace Population\Models\Entytys\Digital\Code;

class UserSshKey extends Base
{

    protected $organizationPerspective = true;

    protected $table = 'code_ssh_keys';

    protected $action = false;

    protected $target = false;

    protected $worker = false;

    public $id;
    public $user;
    public $title;
    public $content;
    public $isInstalled;

    public function __construct()
    {
    }

    public function setarDadosIniciais(User $user, $title = null, $content = null)
    {
        $this->user        = $user;
        $this->title       = $title;
        $this->content     = $content;
        $this->isInstalled = false;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function isInstalled()
    {
        return $this->isInstalled;
    }

    public function setInstalled($isInstalled)
    {
        $this->isInstalled = $isInstalled;
    }
}
