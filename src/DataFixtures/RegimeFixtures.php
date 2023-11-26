<?php

namespace App\DataFixtures;

use App\Factory\RegimeFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class RegimeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $file = file_get_contents(__DIR__.'/data/Regime.json');
        $file_j = json_decode($file, true);
        RegimeFactory::createSequence($file_j);
    }
}
