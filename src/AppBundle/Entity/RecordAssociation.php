<?php

namespace AppBundle\Entity;

use Ds\Component\Association\Entity\Association;
use Ds\Component\Security\Model\Type\Secured;
use AppBundle\Entity\Attribute\Accessor;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints as ORMAssert;
use Symfony\Component\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class RecordAssociation
 *
 * @ApiResource(
 *      attributes={
 *          "normalization_context"={
 *              "groups"={"association_output"}
 *          },
 *          "denormalization_context"={
 *              "groups"={"association_input"}
 *          },
 *          "filters"={
 *              "app.record_association.search",
 *              "app.record_association.date"
 *          }
 *      }
 * )
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RecordAssociationRepository")
 * @ORM\Table(name="app_record_association")
 */
class RecordAssociation extends Association implements Secured
{
    use Accessor\Record;

    /**
     * @var \AppBundle\Entity\Record
     * @ApiProperty
     * @Serializer\Groups({"association_output", "association_input"})
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Record", inversedBy="associations")
     * @ORM\JoinColumn(name="record_id", referencedColumnName="id")
     * @Assert\Valid
     */
    protected $record;
}
