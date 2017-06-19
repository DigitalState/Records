<?php

namespace Ds\Bundle\RecordBundle\Attribute\Accessor;

use Ds\Bundle\RecordBundle\Entity\Record as RecordEntity;

/**
 * Trait Record
 */
trait Record
{
    /**
     * Set record
     *
     * @param \Ds\Bundle\RecordBundle\Entity\Record $record
     * @return object
     */
    public function setRecord(RecordEntity $record = null)
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
}
