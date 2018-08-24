<?php

namespace AppBundle\Fixtures;

use AppBundle\Fixture\RecordFixture;
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
        return 20;
    }

    /**
     * {@inheritdoc}
     */
    protected function getResource()
    {
        return '/srv/api-platform/src/AppBundle/Resources/fixtures/{env}/records.yml';
    }
}
