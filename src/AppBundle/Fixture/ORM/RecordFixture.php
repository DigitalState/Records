<?php

namespace AppBundle\Fixture\ORM;

use AppBundle\Entity\Record;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ORM\ResourceFixture;

/**
 * Class RecordFixture
 */
abstract class RecordFixture extends ResourceFixture
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $records = $this->parse($this->getResource());

        foreach ($records as $record) {
            $entity = new Record;
            $entity
                ->setUuid($record['uuid'])
                ->setOwner($record['owner'])
                ->setOwnerUuid($record['owner_uuid'])
                ->setOwner($record['identity'])
                ->setOwnerUuid($record['identity_uuid'])
                ->setTitle($record['title']);
            $manager->persist($entity);
            $manager->flush();
        }
    }

    /**
     * Get resource
     *
     * @return string
     */
    abstract protected function getResource();
}
