<?php

namespace Ds\Bundle\RecordBundle\Entity;

use Ds\Component\Entity\Entity\Association;
use Ds\Bundle\RecordBundle\Accessor;

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
 *          "filters"={"ds_record.filter.record_association"},
 *          "normalization_context"={"groups"={"association_output"}},
 *          "denormalization_context"={"groups"={"association_input"}}
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