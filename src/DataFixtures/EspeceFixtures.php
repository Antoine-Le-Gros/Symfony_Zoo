<?php

namespace App\DataFixtures;

use App\Factory\EspeceFactory;
use App\Factory\FamilleAnimalFactory;
use App\Factory\RegimeFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EspeceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $file = file_get_contents(__DIR__.'/data/NomEspece.json');
        $file_j = json_decode($file, true);
        $regimes = RegimeFactory::all(); // 0 = carnivores - 1 = herbivores - 2 = omnivores
        $familles = FamilleAnimalFactory::all();
        $regimes_att = [$regimes[2], $regimes[0], $regimes[1], $regimes[2], $regimes[1], $regimes[0], $regimes[0], $regimes[0], $regimes[1], $regimes[1], $regimes[1], $regimes[0], $regimes[1],
            $regimes[0], $regimes[1], $regimes[1], $regimes[0], $regimes[0], $regimes[0], $regimes[1], ];
        $familles_att = [$familles[4], $familles[4], $familles[7], $familles[7], $familles[4], $familles[0], $familles[0], $familles[0], $familles[11], $familles[12], $familles[13], $familles[14], $familles[2],
            $familles[15], $familles[16], $familles[17], $familles[1], $familles[18], $familles[19], $familles[20]];
        for ($i = 0; $i < count($file_j); ++$i) {
            $file_j[$i]['regime'] = $regimes_att[$i];
            $file_j[$i]['famille'] = $familles_att[$i];
        }
        EspeceFactory::createSequence($file_j);
    }

    public function getDependencies(): array
    {
        return [
            FamilleAnimalFixtures::class,
            RegimeFixtures::class,
        ];
    }
}
