<?php

namespace AppBundle\Stat\Record;

use AppBundle\Service\RecordService;
use Ds\Component\Model\Attribute;
use Ds\Component\Statistic\Model\Datum;
use Ds\Component\Statistic\Stat\Stat;

/**
 * Class CountStat
 */
class CountStat implements Stat
{
    use Attribute\Alias;

    /**
     * @var \AppBundle\Service\RecordService
     */
    protected $recordService;

    /**
     * Constructor
     *
     * @param \AppBundle\Service\RecordService $recordService
     */
    public function __construct(RecordService $recordService)
    {
        $this->recordService = $recordService;
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        $datum = new Datum;
        $datum
            ->setAlias($this->alias)
            ->setValue($this->recordService->getRepository()->getCount([]));

        return $datum;
    }
}
