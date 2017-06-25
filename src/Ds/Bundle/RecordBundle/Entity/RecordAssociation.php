<?php

namespace Ds\Bundle\RecordBundle\Entity;

use Ds\Component\Association\Entity\Association;
use Ds\Bundle\RecordBundle\Attribute\Accessor;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;

/**
 * Class RecordAssociation
 *
 * @ApiResource(
 *      attributes={
 *          "filters"={"ds.record_association.search", "ds.record_association.date"},
 *          "normalization_context"={
 *              "groups"={"association_output"}
 *          },
 *          "denormalization_context"={
 *              "groups"={"association_input"}
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="Ds\Bundle\RecordBundle\Repository\RecordAssociationRepository")
 * @ORM\Table(name="ds_record_association")
 */
class RecordAssociation extends Association
{
    use Accessor\Record;

    /**
     * @var \Ds\Bundle\RecordBundle\Entity\Record
     * @ApiProperty
     * @Serializer\Groups({"association_output", "association_input"})
     * @ORM\ManyToOne(targetEntity="Ds\Bundle\RecordBundle\Entity\Record", inversedBy="associations")
     * @ORM\JoinColumn(name="record_id", referencedColumnName="id")
     * @Assert\Valid
     */
    protected $record;
}