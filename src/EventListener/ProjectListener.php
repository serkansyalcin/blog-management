<?php

namespace App\EventListener;

use DateTime;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

/**
 * Class ProjectListener
 * @package App\EventListener
 */
class ProjectListener
{
    /**
     * @param PrePersistEventArgs $args
     *
     * @return void
     */
    public function prePersist(PrePersistEventArgs $args):void
    {
        $entity = $args->getObject();
        if (method_exists($entity, 'setDateCreated')) {
            if ($entity->getDateCreated() == null) {
                $entity->setDateCreated(new DateTime());
            }
        }
    }

    /**
     * @param PreUpdateEventArgs $args
     *
     * @return void
     */
    public function preUpdate(PreUpdateEventArgs $args):void
    {
        $entity = $args->getObject();

        if (method_exists($entity, 'setDateModified')) {
            $entity->setDateModified(new DateTime());
        }
    }
}
