<?php

namespace App\DataFixtures;

use App\Factory\ImageFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ImageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        ImageFactory::createMany(2);
    }

    public function getDependencies(): array
    {
        return [
            EspeceFixtures::class,
            AnimalFixtures::class,
            FamilleAnimalFixtures::class,
        ];
    }
}
