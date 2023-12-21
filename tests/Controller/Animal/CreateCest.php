<?php

namespace Controller\Animal;

use App\Entity\Animal;
use App\Factory\EnclosureFactory;
use App\Factory\SpeciesFactory;
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

        $I->click('Créer');
        $I->seeCurrentUrlEquals('/animal/create');
    }

    // Activate "extension=fileinfo" in PHP.ini
    public function formWithDataIsOk(ControllerTester $I): void
    {
        EnclosureFactory::createOne(['name' => 'Le cirque']);
        SpeciesFactory::createOne(['name' => 'stone']);

        $I->amOnPage('/animal/create');

        $I->fillField('Nom de l\'animal', 'Pierre');
        $I->fillField('Description de l\'animal', 'Pierre est un cailloux');
        $I->selectOption('Espèce de l\'animal', 'stone');
        $I->selectOption('Enclosure de l\'animal', 'Le cirque');
        $I->attachFile('Image de l\'animal', './Animal-formWithDataIsOk-image.jpg');
        $I->click('Créer');

        $I->seeCurrentUrlEquals('/animal/1');
        $I->SeeInRepository(Animal::class, [
            'name' => 'Pierre',
            'description' => 'Pierre est un cailloux',
            'species' => [
                'name' => 'stone',
            ],
            'enclosure' => [
                'name' => 'Le cirque',
            ],
        ]);
    }
}
