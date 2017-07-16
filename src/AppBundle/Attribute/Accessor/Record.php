<?php

namespace AppBundle\Attribute\Accessor;

use AppBundle\Entity\Record as RecordEntity;

/**
 * Trait Record
 */
trait Record
{
    /**
     * Set record
     *
     * @param \AppBundle\Entity\Record $record
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
     * @return \AppBundle\Entity\Record
     */
    public function getRecord()
    {
        return $this->record;
    }
}
