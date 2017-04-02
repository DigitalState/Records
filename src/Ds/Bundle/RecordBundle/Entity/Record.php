<?php

namespace Ds\Bundle\RecordBundle\Entity;

use Ds\Component\Entity\Entity\Uuidentifiable;
use Ds\Component\Entity\Entity\Accessor;
use Doctrine\Common\Collections\ArrayCollection;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation As Serializer;
use Gedmo\Mapping\Annotation as Behavior;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Record
 *
 * @ApiResource(
 *      attributes={
 *          "filters"={"ds_record.record.filter"},
 *          "normalization_context"={"groups"={"record_output"}},
 *          "denormalization_context"={"groups"={"record_input"}}
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\RecordBundle\Repository\RecordRepository")
 * @ORM\Table(name="ds_record")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\HasLifecycleCallbacks
 * @ORMAssert\UniqueEntity(fields="uuid", message="ds_entity.uuid.unique")
 */
class Record implements Uuidentifiable
{
    /**
     * @var integer
     *
     * @ApiProperty(identifier=false)
     * @Serializer\Groups({"record_output_admin"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id; use Accessor\Id;

    /**
     * @var string
     *
     * @ApiProperty(identifier=true)
     * @Serializer\Groups({"record_output"})
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    protected $uuid; use Accessor\Uuid;

    /**
     * @var \DateTime
     *
     * @Serializer\Groups({"record_output_admin"})
     * @Behavior\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt; use Accessor\CreatedAt;

    /**
     * @var \DateTime
     *
     * @Serializer\Groups({"record_output_admin"})
     * @Behavior\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt; use Accessor\UpdatedAt;

    /**
     * @var string
     *
     * @Serializer\Groups({"record_output_admin", "record_input_admin"})
     * @ORM\Column(name="`owner`", type="string")
     * @Assert\NotBlank
     */
    protected $owner; use Accessor\Owner;

    /**
     * @var string
     *
     * @Serializer\Groups({"record_output_admin", "record_input_admin"})
     * @ORM\Column(name="owner_uuid", type="guid")
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    protected $ownerUuid; use Accessor\OwnerUuid;

    /**
     * @var string
     *
     * @Serializer\Groups({"record_output_admin", "record_input_admin"})
     * @ORM\Column(name="`handler`", type="string")
     * @Assert\NotBlank
     */
    protected $handler; use Accessor\Handler;

    /**
     * @var string
     *
     * @Serializer\Groups({"record_output_admin", "record_input_admin"})
     * @ORM\Column(name="handler_uuid", type="guid")
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    protected $handlerUuid; use Accessor\HandlerUuid;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @Serializer\Groups({"record_output"})
     * @ORM\OneToMany(targetEntity="Ds\Bundle\RecordBundle\Entity\Association", mappedBy="record", cascade={"persist", "remove"})
     */
    protected $associations; # region accessors

    /**
     * Add association
     *
     * @param \Ds\Bundle\RecordBundle\Entity\Association $association
     * @return \Ds\Bundle\RecordBundle\Entity\Record
     */
    public function addAssociation(Association $association)
    {
        $association->setRecord($this);
        $this->associations[] = $association;

        return $this;
    }

    /**
     * Remove association
     *
     * @param \Ds\Bundle\RecordBundle\Entity\Association $association
     */
    public function removeAssociation(Association $association)
    {
        $this->associations->removeElement($association);
    }

    /**
     * Get associations
     *
     * @return array
     */
    public function getAssociations()
    {
        return $this->associations->toArray();
    }

    # endregion

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->associations = new ArrayCollection;
    }
}
