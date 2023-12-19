<?php

namespace App\DataFixtures;

use App\Factory\EnclosFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EnclosFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $file = file_get_contents(__DIR__.'/data/Enclos.json');
        $file_j = json_decode($file, true);
        EnclosFactory::createSequence($file_j);
    }
}
