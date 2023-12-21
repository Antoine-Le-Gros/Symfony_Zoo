<?php

namespace Controller\Species;

use App\Factory\SpeciesFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function DisplayTenSpecies(ControllerTester $I): void
    {
        SpeciesFactory::createMany(10);

        $I->amOnPage('/species');
        $I->seeResponseCodeIs(200);

        $I->seeInTitle('Liste des espèces');
        $I->see('Liste des espèces ', 'h1');
        $I->seeNumberOfElements('.especesAnimal li>a[href]', 10);
    }

    public function listAnimalOfOneSpecies(ControllerTester $I): void
    {
        SpeciesFactory::createOne([
            'name' => 'stone',
            'description' => 'pierre',
        ]);

        $I->amOnPage('/species');
        $I->seeResponseCodeIs(200);

        $I->click('.especesAnimal .species-list a.nav-link');
        $I->seeCurrentUrlEquals('/animals/1');
    }

    public function isListofSpeciesSorted(ControllerTester $I): void
    {
        SpeciesFactory::createSequence(
            [
                ['name' => 'Pierre'],
                ['name' => 'Antoine'],
                ['name' => 'Gabriellebg'],
                ['name' => 'Feur'],
            ]
        );

        $I->amOnPage('/species');
        $I->seeResponseCodeIs(200);

        $I->assertEquals([
            'Antoine',
            'Feur',
            'Gabriellebg',
            'Pierre',
        ],
            $I->grabMultiple('.libEspece'));
    }

    public function testSearchSpecies(ControllerTester $I): void
    {
        SpeciesFactory::createSequence(
            [
                ['name' => 'Pierre'],
                ['name' => 'Antoine'],
                ['name' => 'Gabriellebg'],
                ['name' => 'Gabriellebg2'],
                ['name' => 'Feur'],
            ]
        );

        $I->amOnPage('/species?search=Gabriellebg');
        $I->seeResponseCodeIs(200);

        $I->assertEquals([
            'Gabriellebg',
            'Gabriellebg2',
        ], $I->grabMultiple('.libEspece'));
    }
}
