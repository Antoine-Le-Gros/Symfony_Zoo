<?php

namespace App\DataFixtures;

use App\Factory\FamilleAnimalFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FamilleAnimalFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $file = file_get_contents(__DIR__.'/data/Famille.json');
        $file_j = json_decode($file, true);
        FamilleAnimalFactory::createSequence($file_j);
    }

        $manager->flush();
    }
}
