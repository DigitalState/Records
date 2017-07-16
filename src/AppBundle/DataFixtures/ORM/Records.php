<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Fixture\ORM\RecordFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

/**
 * Class Records
 */
class Records extends RecordFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 10;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return __DIR__.'/../../Resources/data/{server}/records.yml';
    }
}
