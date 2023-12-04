<?php

namespace App\Tests\Controller\Animal;

use App\Factory\CategorieAnimalFactory;
use App\Factory\EnclosFactory;
use App\Factory\EspeceFactory;
use App\Factory\FamilleAnimalFactory;
use App\Factory\RegimeFactory;
use App\Tests\Support\ControllerTester;

class CreateCest
{
    public function formCreateAnimal(ControllerTester $I): void
    {
        $I->amOnPage('/animal/create');
        $I->seeInTitle("Création d'un nouvel animal");
        $I->see("Création d'un nouvel animal", 'h1');
    }

    public function formErrorWithNoData(ControllerTester $I): void
    {
        $I->amOnPage('/animal/create');
        $I->submitForm('form', [], 'Créer');
        $I->seeCurrentRouteIs('app_animal_create');
    }

    // Activate "extension=fileinfo" in PHP.ini
    public function formWithDataIsOk(ControllerTester $I): void
    {
        RegimeFactory::createOne();
        CategorieAnimalFactory::createOne();
        FamilleAnimalFactory::createOne();
        $enclos = EnclosFactory::createOne(['nomEnclos' => 'Le cirque']);
        $espece = EspeceFactory::createOne(['libEspece' => 'stone']);

        $I->amOnPage('/animal/create');
        $I->attachFile('animal[image]', './Animal-formWithDataIsOk-image.jpg');
        $I->submitForm('form', [
            'animal[nomAnimal]' => 'Pierre',
            'animal[descriptionAnimal]' => 'Pierre est un cailloux',
            'animal[espece]' => $espece->getId(),
            'animal[enclos]' => $enclos->getId(),
        ], 'Créer');
        $I->seeCurrentRouteIs('app_animal_show', ['id' => 1]);
    }
}
