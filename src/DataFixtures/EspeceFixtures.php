<?php

namespace App\DataFixtures;

use App\Factory\EspeceFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EspeceFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $file = file_get_contents(__DIR__.'/data/NomEspece.json');
        $file_j = json_decode($file, true);
        EspeceFactory::createSequence($file_j);
    }

        $manager->flush();
    }
}
