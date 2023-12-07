<?php

namespace App\Tests\Controller\Animal;

use App\Entity\Animal;
use App\Factory\AnimalFactory;
use App\Tests\Support\ControllerTester;

class DeleteCest
{
    /*
    public function accessIsRestrictedForNoAdmin(ControllerTester $I): void
    {
        $I->amOnPage('/animal/create');
        $I->amOnRoute('app_login');
    }
 */

    public function formDeleteAnimal(ControllerTester $I): void
    {
        // $adminUser = UtilisateurFactory::createOne(['roles' => ['ROLE_ADMIN']])->object();
        // $I->amLoggedInAs($adminUser);

        AnimalFactory::createOne([
            'nomAnimal' => 'Pierre',
            'descriptionAnimal' => 'Pierre est un cailloux',
        ]);

        $I->amOnPage('/animal/1/delete');
        $I->seeInTitle('Suppression de Pierre');
        $I->see('Suppression de Pierre', 'h1');
    }

    public function formDeleteAnimalDenied(ControllerTester $I): void
    {
        // $adminUser = UtilisateurFactory::createOne(['roles' => ['ROLE_ADMIN']])->object();
        // $I->amLoggedInAs($adminUser);

        AnimalFactory::createOne([
            'nomAnimal' => 'Pierre',
            'descriptionAnimal' => 'Pierre est un cailloux',
        ]);

        $I->amOnPage('/animal/1/delete');
        $I->click('Annuler');

        $I->seeCurrentRouteIs('app_animal_show', ['id' => 1]);
    }

    public function formDeleteAnimalAccepted(ControllerTester $I): void
    {
        // $adminUser = UtilisateurFactory::createOne(['roles' => ['ROLE_ADMIN']])->object();
        // $I->amLoggedInAs($adminUser);

        AnimalFactory::createOne([
            'nomAnimal' => 'Pierre',
            'descriptionAnimal' => 'Pierre est un cailloux',
        ]);

        $I->amOnPage('/animal/1/delete');
        $I->click('Supprimer');

        $I->seeCurrentRouteIs('app_animal');
        $I->dontSeeInRepository(Animal::class, [
            'nomAnimal' => 'Pierre',
            'descriptionAnimal' => 'Pierre est un cailloux',
        ]);
    }
}
