<?php

namespace App\Tests\Controller\Animal;

use App\Entity\Animal;
use App\Factory\AnimalFactory;
use App\Factory\CategorieAnimalFactory;
use App\Factory\EnclosFactory;
use App\Factory\EspeceFactory;
use App\Factory\FamilleAnimalFactory;
use App\Factory\RegimeFactory;
use App\Tests\Support\ControllerTester;
use Zenstruck\Foundry\Proxy;

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
        $animal = $this->generateAnimalDB();

        $I->amOnPage("/animal/{$animal->getId()}/delete");
        $I->seeInTitle("Suppression de {$animal->getNomAnimal()}");
        $I->see("Suppression de {$animal->getNomAnimal()}", 'h1');
    }

    private function generateAnimalDB(): Proxy|Animal
    {
        RegimeFactory::createOne();
        CategorieAnimalFactory::createOne();
        FamilleAnimalFactory::createOne();
        EnclosFactory::createOne();
        EspeceFactory::createOne();

        return AnimalFactory::createOne();
    }

    public function formDeleteAnimalDenied(ControllerTester $I): void
    {
        // $adminUser = UtilisateurFactory::createOne(['roles' => ['ROLE_ADMIN']])->object();
        // $I->amLoggedInAs($adminUser);

        $animal = $this->generateAnimalDB();

        $I->amOnPage("/animal/{$animal->getId()}/delete");
        $I->click('#form_cancel');

        $I->seeCurrentRouteIs('app_animal_show', ['id' => $animal->getId()]);
    }

    public function formDeleteAnimalAccepted(ControllerTester $I): void
    {
        // $adminUser = UtilisateurFactory::createOne(['roles' => ['ROLE_ADMIN']])->object();
        // $I->amLoggedInAs($adminUser);

        $animal = $this->generateAnimalDB();

        $I->amOnPage("/animal/{$animal->getId()}/delete");
        $I->click('#form_delete');

        $I->seeCurrentRouteIs('app_animal');
    }
}
