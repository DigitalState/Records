<?php

namespace App\Service;

use App\Entity\RecordAssociation;
use Doctrine\ORM\EntityManagerInterface;
use Ds\Component\Entity\Service\EntityService;

/**
 * Class RecordAssociationService
 */
final class RecordAssociationService extends EntityService
{
    /**
     * Constructor
     *
     * @param \Doctrine\ORM\EntityManagerInterface $manager
     * @param string $entity
     */
    public function __construct(EntityManagerInterface $manager, string $entity = RecordAssociation::class)
    {
        parent::__construct($manager, $entity);
    }
}
