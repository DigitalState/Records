<?php

namespace App\Entity;

use Ds\Component\Association\Entity\Association;
use App\Entity\Attribute\Accessor;

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
 * @ORM\Entity(repositoryClass="App\Repository\RecordAssociationRepository")
 * @ORM\Table(name="app_record_association")
 * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
 */
class RecordAssociation extends Association
{
    use Accessor\Record;

    /**
     * @var \App\Entity\Record
     * @ApiProperty
     * @Serializer\Groups({"association_output", "association_input"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Record", inversedBy="associations")
     * @ORM\JoinColumn(name="record_id", referencedColumnName="id")
     * @ORM\Cache(usage="NONSTRICT_READ_WRITE")
     * @Assert\Valid
     */
    private $record;
}