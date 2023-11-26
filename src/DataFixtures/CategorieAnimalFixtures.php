<?php

namespace App\DataFixtures;

use App\Factory\CategorieAnimalFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieAnimalFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $file = file_get_contents(__DIR__.'/data/CategorieAnimale.json');
        $file_j = json_decode($file, true);
        CategorieAnimalFactory::createSequence($file_j);
    }
}
