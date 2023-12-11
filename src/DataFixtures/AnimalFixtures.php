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
    /*   public function load(ObjectManager $manager): void
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
*/
    public function load(ObjectManager $manager): void
    {
        $file = file_get_contents(__DIR__.'/data/Animals.json');
        $file_j = json_decode($file, true);
        $espece = EspeceFactory::all();
        $enclos = EnclosFactory::all();
        for ($i = 0; $i < count($file_j); ++$i) {
            $file_j['espece'] = $espece[$i];
            $file_j['enclos'] = $enclos[$i];
        }
        AnimalFactory::createSequence($file_j);
    }

    public function getDependencies(): array
    {
        return [
            EspeceFixtures::class,
            EnclosFixtures::class,
        ];
    }
}
