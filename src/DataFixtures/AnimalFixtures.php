<?php

namespace App\DataFixtures;

use App\Factory\AnimalFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AnimalFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        AnimalFactory::createMany(20);
    }

    public function getDependencies(): array
    {
        return [
            EspeceFixtures::class,
            EnclosFixtures::class,
        ];
    }
}
