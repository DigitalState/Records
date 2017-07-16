<?php

namespace AppBundle\Service;

use AppBundle\Entity\RecordAssociation;
use Doctrine\ORM\EntityManager;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class RecordAssociationService
 */
class RecordAssociationService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManager $manager
     * @param string $entity
     */
    public function __construct(EntityManager $manager, $entity = RecordAssociation::class)
    {
        parent::__construct($manager, $entity);
    }
}
