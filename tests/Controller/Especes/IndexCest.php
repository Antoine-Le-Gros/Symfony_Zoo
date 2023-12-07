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

    public function listAnimalOfOneEspece(ControllerTester $I): void
    {
        EspeceFactory::createOne([
            'libEspece' => 'stone',
            'descriptionEspece' => 'pierre',
        ]);

        $I->amOnPage('/especes');
        $I->seeResponseCodeIs(200);

        $I->click('.especesAnimal .species-list a.nav-link');
        $I->seeCurrentUrlEquals('/animals/1');
    }

    public function isListofEspeceSorted(ControllerTester $I): void
    {
        EspeceFactory::createSequence(
            [
                ['libEspece' => 'Pierre'],
                ['libEspece' => 'Antoine'],
                ['libEspece' => 'Gabriellebg'],
                ['libEspece' => 'Feur'],
            ]
        );

        $I->amOnPage('/especes');
        $I->seeResponseCodeIs(200);

        $I->assertEquals([
            'Antoine',
            'Feur',
            'Gabriellebg',
            'Pierre',
        ],
            $I->grabMultiple('.libEspece'));
    }

    public function testSearchEspece(ControllerTester $I): void
    {
        EspeceFactory::createSequence(
            [
                ['libEspece' => 'Pierre'],
                ['libEspece' => 'Antoine'],
                ['libEspece' => 'Gabriellebg'],
                ['libEspece' => 'Gabriellebg2'],
                ['libEspece' => 'Feur'],
            ]
        );

        $I->amOnPage('/especes?search=Gabriellebg');
        $I->seeResponseCodeIs(200);

        $I->assertEquals([
            'Gabriellebg',
            'Gabriellebg2',
        ], $I->grabMultiple('.libEspece'));
    }
}
