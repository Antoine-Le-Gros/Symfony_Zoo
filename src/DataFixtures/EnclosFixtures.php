<?php

namespace App\DataFixtures;

use App\Factory\EnclosFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EnclosFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        EnclosFactory::createMany(5);
    }
}
