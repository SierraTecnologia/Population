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
use Doctrine\ORM\NoResultException;
use Population\Models\Entytys\Digital\Code\User;

class UserForgotPasswordRepository extends EntityRepository
{
    public function findOneByUser(User $user)
    {
        $queryBuilder = $this
            ->createQueryBuilder('t')
            ->where('t.user = :user')
            ->setParameters(array(
                'user' => $user,
            ))
        ;

        try {
            return $queryBuilder->getQuery()->getSingleResult();
        } catch (NoResultException $e) {
            return $user->createForgotPasswordToken();
        }
    }
}
