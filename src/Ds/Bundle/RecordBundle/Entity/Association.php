<?php

namespace Ds\Bundle\RecordBundle\Entity;

use Ds\Component\Entity\Entity\Uuidentifiable;
use Ds\Component\Entity\Entity\Accessor;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation As Serializer;
use Gedmo\Mapping\Annotation as Behavior;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Association
 *
 * @ApiResource(
 *      attributes={
 *          "filters"={"ds_record.association.filter"},
 *          "normalization_context"={"groups"={"record_association_output"}},
 *          "denormalization_context"={"groups"={"record_association_input"}}
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\RecordBundle\Repository\AssociationRepository")
 * @ORM\Table(name="ds_record_association")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\HasLifecycleCallbacks
 * @ORMAssert\UniqueEntity(fields="uuid")
 */
class Association implements Uuidentifiable
{
    /**
     * @var integer
     *
     * @ApiProperty(identifier=false)
     * @Serializer\Groups({"record_association_output_admin"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    protected $id; use Accessor\Id;

    /**
     * @var string
     *
     * @ApiProperty(identifier=true)
     * @Serializer\Groups({"record_association_output"})
     * @ORM\Column(name="uuid", type="guid", unique=true)
     * @Assert\Uuid
     */
    protected $uuid; use Accessor\Uuid;

    /**
     * @var \DateTime
     *
     * @Serializer\Groups({"record_association_output_admin"})
     * @Behavior\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt; use Accessor\CreatedAt;

    /**
     * @var \DateTime
     *
     * @Serializer\Groups({"record_association_output_admin"})
     * @Behavior\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt; use Accessor\UpdatedAt;

    /**
     * @var string
     *
     * @Serializer\Groups({"record_association_output", "record_association_input"})
     * @ORM\Column(name="entity", type="string")
     * @Assert\NotBlank
     */
    protected $entity; use Accessor\Entity;

    /**
     * @var string
     *
     * @Serializer\Groups({"record_association_output", "record_association_input"})
     * @ORM\Column(name="entity_uuid", type="guid")
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    protected $entityUuid; use Accessor\EntityUuid;

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
     * @Serializer\Groups({"record_association_output_admin", "record_association_input_admin"})
     * @ORM\Column(name="handler_uuid", type="guid")
     * @Assert\NotBlank
     * @Assert\Uuid
     */
    protected $handlerUuid; use Accessor\HandlerUuid;

    /**
     * @var \Ds\Bundle\RecordBundle\Entity\Record
     *
     * @Serializer\Groups({"record_association_output", "record_association_input"})
     * @ORM\ManyToOne(targetEntity="Ds\Bundle\RecordBundle\Entity\Record", inversedBy="associations")
     * @ORM\JoinColumn(name="record_id", referencedColumnName="id")
     * @assert\Valid
     */
    protected $record; # region accessors

    /**
     * Set record
     *
     * @param \Ds\Bundle\RecordBundle\Entity\Record $record
     * @return \Ds\Bundle\RecordBundle\Entity\Record
     */
    public function setRecord(Record $record = null)
    {
        $this->record = $record;

        return $this;
    }

    /**
     * Get record
     *
     * @return \Ds\Bundle\RecordBundle\Entity\Record
     */
    public function getRecord()
    {
        return $this->record;
    }

    # endregion
}
