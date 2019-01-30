<?php

namespace App\Entity\Attribute\Accessor;

use App\Entity\Record as RecordEntity;

/**
 * Trait Record
 */
trait Record
{
    /**
     * Set record
     *
     * @param \App\Entity\Record $record
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
     * @return \App\Entity\Record
     */
    public function getRecord()
    {
        return $this->record;
    }
}
