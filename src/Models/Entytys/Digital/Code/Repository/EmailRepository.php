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
use Population\Models\Entytys\Digital\Code;

class EmailRepository extends EntityRepository
{
    public function getEmailFromActivation($username, $token)
    {
        $queryBuilder = $this
            ->createQueryBuilder('email')
            ->leftJoin('email.user', 'user')
            ->where('user.username = :username')
            ->andWhere('email.activationToken = :token')
            ->setParameters(array(
                'username' => $username,
                'token'     => $token,
            ))
        ;

        try {
            return $queryBuilder->getQuery()->getSingleResult();
        } catch (NoResultException $e) {
            return null;
        }
    }
}
