<?php

namespace App\Tests\Controller\Animal;

use App\Factory\AnimalFactory;
use App\Factory\CategorieAnimalFactory;
use App\Factory\EnclosFactory;
use App\Factory\EspeceFactory;
use App\Factory\FamilleAnimalFactory;
use App\Factory\RegimeFactory;
use App\Tests\Support\ControllerTester;

class DeleteCest
{
    public function formDeleteAnimal(ControllerTester $I): void
    {
        RegimeFactory::createOne();
        CategorieAnimalFactory::createOne();
        FamilleAnimalFactory::createOne();
        EnclosFactory::createOne();
        EspeceFactory::createOne();
        $animal = AnimalFactory::createOne(['nomAnimal' => 'Pierre']);

        $I->amOnPage("/animal/{$animal->getId()}/delete");
        $I->seeInTitle("Suppression de {$animal->getNomAnimal()}");
        $I->see("Suppression de {$animal->getNomAnimal()}", 'h1');
    }

    // tests
    public function tryToTest(ControllerTester $I)
    {
    }
}
