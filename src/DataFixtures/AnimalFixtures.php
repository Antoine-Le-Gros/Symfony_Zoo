<?php

namespace App\DataFixtures;

use App\Factory\AnimalFactory;
use App\Factory\EnclosFactory;
use App\Factory\EspeceFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AnimalFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        AnimalFactory::createMany(20, function () {
            if (AnimalFactory::faker()->boolean(30)) {
                $espece = EspeceFactory::random();
                $enclos = EnclosFactory::random();

                return [
                    'espece' => $espece,
                    'enclos' => $enclos,
                    'parent1' => AnimalFactory::new([
                        'espece' => $espece,
                        'enclos' => $enclos,
                    ]),
                    'parent2' => AnimalFactory::new([
                        'espece' => $espece,
                        'enclos' => $enclos,
                    ]),
                ];
            }

            return [];
        });
    }

    public function getDependencies(): array
    {
        return [
            EspeceFixtures::class,
            EnclosFixtures::class,
        ];
    }
}
