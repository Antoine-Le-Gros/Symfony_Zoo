<?php

namespace Controller\AnimalFamily;

use App\Factory\AnimalCategoryFactory;
use App\Factory\AnimalFamilyFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function DefaultNumberOfFamilyIs10(ControllerTester $I): void
    {
        AnimalFamilyFactory::createMany(10);

        $I->amOnPage('/families');
        $I->seeResponseCodeIs(200);

        $I->seeInTitle('Liste des familles');
        $I->see('Liste des familles ', 'h1');
        $I->seeNumberOfElements('ul.container>li.card', 10);
    }

    public function clickOnFirstElementOfFamilyList(ControllerTester $I): void
    {
        AnimalFamilyFactory::createOne(
            [
                'name' => 'canidé',
                'description' => 'description',
            ]);

        $I->amOnPage('/families');
        $I->seeResponseCodeIs(200);

        $I->click('Voir les espèces appartenant à cette famille');
        $I->seeCurrentUrlEquals('/species/1');
    }

    public function isListofFamilySorted(ControllerTester $I): void
    {
        AnimalFamilyFactory::createSequence(
            [
                ['name' => 'homnidé'],
                ['name' => 'bovidé'],
                ['name' => 'félidé'],
                ['name' => 'cerbidé'],
            ]
        );

        $I->amOnPage('/families');
        $I->seeResponseCodeIs(200);

        $I->assertEquals([
            'bovidé',
            'cerbidé',
            'félidé',
            'homnidé',
        ],
            $I->grabMultiple('.famillesAnimal li a p'));
    }

    public function testSearchForFamilyList(ControllerTester $I): void
    {
        AnimalFamilyFactory::createSequence(
            [
                ['name' => 'homnidé'],
                ['name' => 'bovidé'],
                ['name' => 'félidé'],
                ['name' => 'cervidé'],
                ['name' => 'cebidé'],
            ]
        );

        $I->amOnPage('/families/?search=ce');
        $I->seeResponseCodeIs(200);

        $I->assertEquals([
            'cebidé',
            'cervidé',
        ], $I->grabMultiple('.famillesAnimal li a p'));
    }

    public function listOfFamilyAccordingCategory(ControllerTester $I): void
    {
        AnimalCategoryFactory::createOne([
            'name' => 'mammifère',
            'description' => 'description',
        ]);

        $I->amOnPage('/categories');

        $I->click('mammifère description');
        $I->seeResponseCodeIs(200);

        $I->seeCurrentUrlEquals('/families/1');
    }
}
