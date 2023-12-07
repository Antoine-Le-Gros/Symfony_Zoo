<?php

namespace App\Tests\Controller\Especes;

use App\Factory\EspeceFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function DisplayTenEspece(ControllerTester $I): void
    {
        EspeceFactory::createMany(10);

        $I->amOnPage('/especes');
        $I->seeResponseCodeIs(200);

        $I->seeInTitle('Liste des espèces');
        $I->see('Liste des espèces ', 'h1');
        $I->seeNumberOfElements('.especesAnimal li>a[href]', 10);
    }

    // tests
    public function tryToTest(ControllerTester $I)
    {
    }
}
