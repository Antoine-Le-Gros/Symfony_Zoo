<?php

namespace App\DataFixtures;

use App\Factory\AnimalFactory;
use App\Factory\EnclosFactory;
use App\Factory\EvenementFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EvenementFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $files = file_get_contents(__DIR__.'/data/Evenement.json');
        $file_j = json_decode($files, true);
        $enclos = EnclosFactory::all();
        $animal = AnimalFactory::all();

        for ($i = 0; $i < count($file_j); ++$i) {
            $file_j[$i]['enclos'] = $enclos[$i];
            $file_j[$i]['dateEvenement']=\DateTime::createFromFormat('Y-m-d', '2024-11-24');

        }
        EvenementFactory::createSequence($file_j);
    }

    public function getDependencies(): array
    {
        return [
            EnclosFixtures::class,
            AnimalFixtures::class,
        ];
    }
}
