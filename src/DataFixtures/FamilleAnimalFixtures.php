<?php

namespace App\DataFixtures;

use App\Factory\CategorieAnimalFactory;
use App\Factory\FamilleAnimalFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FamilleAnimalFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $file = file_get_contents(__DIR__.'/data/Famille.json');
        $file_j = json_decode($file, true);
        $cat = CategorieAnimalFactory::all();
        $catFamilly = [$cat[0], $cat[0], $cat[0], $cat[0], $cat[0], $cat[0], $cat[0], $cat[0], $cat[1], $cat[2], $cat[3], $cat[0], $cat[0], $cat[0],
            $cat[1], $cat[1], $cat[0], $cat[0], $cat[1], $cat[2], $cat[2]];
        for ($i = 0; $i < count($file_j); ++$i) {
            $file_j[$i]['categorie'] = $catFamilly[$i];
        }
        FamilleAnimalFactory::createSequence($file_j);
    }

    public function getDependencies(): array
    {
        return [
            CategorieAnimalFixtures::class,
        ];
    }
}
