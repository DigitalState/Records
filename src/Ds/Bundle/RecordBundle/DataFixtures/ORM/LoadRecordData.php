<?php

namespace Ds\Bundle\RecordBundle\DataFixtures\ORM;

use Ds\Component\Migration\Fixture\ORM\ResourceFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Bundle\RecordBundle\Entity\Record;

/**
 * Class LoadRecordData
 */
class LoadRecordData extends ResourceFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $records = $this->parse(__DIR__.'/../../Resources/data/{server}/records.yml');

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
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
