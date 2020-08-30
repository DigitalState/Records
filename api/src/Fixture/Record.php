<?php

namespace App\Fixture;

use App\Entity\Record as RecordEntity;
use DateTime;
use Doctrine\Common\Persistence\ObjectManager;
use Ds\Component\Database\Fixture\Yaml;

/**
 * Trait Record
 */
trait Record
{
    use Yaml;

    /**
     * @var string
     */
    private $path;

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $objects = $this->parse($this->path);

        foreach ($objects as $object) {
            $record = new RecordEntity;
            $record
                ->setUuid($object->uuid)
                ->setOwner($object->owner)
                ->setOwnerUuid($object->owner_uuid)
                ->setIdentity($object->identity)
                ->setIdentityUuid($object->identity_uuid)
                ->setTitle((array) $object->title)
                ->setData((array) $object->data)
                ->setTenant($object->tenant);

            if (null !== $object->created_at) {
                $date = new DateTime;
                $date->setTimestamp($object->created_at);
                $record->setCreatedAt($date);
            }

            $manager->persist($record);
            $manager->flush();
        }
    }
}
