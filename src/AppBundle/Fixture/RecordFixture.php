<?php

namespace AppBundle\Fixture;

use AppBundle\Entity\Record;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\ResourceFixture;

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
        $objects = $this->parse($this->getResource());

        foreach ($objects as $object) {
            $record = new Record;
            $record
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setOwner($object->identity)
                ->setOwnerUuid($object->identity_uuid)
                ->setTitle((array) $object->title)
                ->setTenant($object->tenant);
            $manager->persist($record);
            $manager->flush();
        }
    }
}
