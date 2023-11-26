<?php

namespace App\DataFixtures;

use App\Factory\EvenementFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EvenementFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        EvenementFactory::createMany(10);
    }

    public function getDependencies(): array
    {
        return [
            EnclosFixtures::class,
        ];
    }
}
