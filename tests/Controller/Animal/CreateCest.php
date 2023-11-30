<?php

namespace App\Tests\Controller\Animal;

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
}
