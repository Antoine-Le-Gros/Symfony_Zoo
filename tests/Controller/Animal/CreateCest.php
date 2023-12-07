<?php

namespace App\Tests\Controller\Animal;

use App\Entity\Animal;
use App\Factory\EnclosFactory;
use App\Factory\EspeceFactory;
use App\Tests\Support\ControllerTester;

class CreateCest
{
    /*
    public function accessIsRestrictedForNoAdmin(ControllerTester $I): void
    {
        $I->amOnPage('/animal/create');
        $I->amOnRoute('app_login');
    }
     */

    public function formCreateAnimal(ControllerTester $I): void
    {
        // $adminUser = UtilisateurFactory::createOne(['roles' => ['ROLE_ADMIN']])->object();
        // $I->amLoggedInAs($adminUser);

        $I->amOnPage('/animal/create');

        $I->seeInTitle("Création d'un nouvel animal");
        $I->see("Création d'un nouvel animal", 'h1');
    }

    public function formErrorWithNoData(ControllerTester $I): void
    {
        // $adminUser = UtilisateurFactory::createOne(['roles' => ['ROLE_ADMIN']])->object();
        // $I->amLoggedInAs($adminUser);

        $I->amOnPage('/animal/create');

        $I->click('Créer');
        $I->seeCurrentUrlEquals('/animal/create');
    }

    // Activate "extension=fileinfo" in PHP.ini
    public function formWithDataIsOk(ControllerTester $I): void
    {
        // $adminUser = UtilisateurFactory::createOne(['roles' => ['ROLE_ADMIN']])->object();
        // $I->amLoggedInAs($adminUser);

        EnclosFactory::createOne(['nomEnclos' => 'Le cirque']);
        EspeceFactory::createOne(['libEspece' => 'stone']);

        $I->amOnPage('/animal/create');

        $I->fillField('Nom de l\'animal', 'Pierre');
        $I->fillField('Description de l\'animal', 'Pierre est un cailloux');
        $I->selectOption('Espèce de l\'animal', 'stone');
        $I->selectOption('Enclos de l\'animal', 'Le cirque');
        $I->attachFile('Image de l\'animal', './Animal-formWithDataIsOk-image.jpg');
        $I->click('Créer');

        $I->seeCurrentUrlEquals('/animal/1');
        $I->SeeInRepository(Animal::class, [
            'nomAnimal' => 'Pierre',
            'descriptionAnimal' => 'Pierre est un cailloux',
            'espece' => [
                'libEspece' => 'stone',
            ],
            'enclos' => [
                'nomEnclos' => 'Le cirque',
            ],
        ]);
    }
}
