<?php

namespace App\Tests\Controller\FamilleAnimal;

use App\Factory\CategorieAnimalFactory;
use App\Factory\FamilleAnimalFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function DefaultNumberOfFamilyIs10(ControllerTester $I): void
    {
        FamilleAnimalFactory::createMany(10);

        $I->amOnPage('/families');
        $I->seeResponseCodeIs(200);

        $I->seeInTitle('Liste des familles');
        $I->see('Liste des familles ', 'h1');
        $I->seeNumberOfElements('.famillesAnimal li>a[href]', 10);
    }

    public function clickOnFirstElementOfFamilyList(ControllerTester $I): void
    {
        FamilleAnimalFactory::createOne(
            [
                'nomFamille' => 'canidé',
                'descriptionFamille' => 'description',
            ]);

        $I->amOnPage('/families');
        $I->seeResponseCodeIs(200);

        $I->click('canidé description');
        $I->seeCurrentUrlEquals('/especes/1');
    }

    public function isListofFamilySorted(ControllerTester $I): void
    {
        FamilleAnimalFactory::createSequence(
            [
                ['nomFamille' => 'homnidé'],
                ['nomFamille' => 'bovidé'],
                ['nomFamille' => 'félidé'],
                ['nomFamille' => 'cerbidé'],
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
        FamilleAnimalFactory::createSequence(
            [
                ['nomFamille' => 'homnidé'],
                ['nomFamille' => 'bovidé'],
                ['nomFamille' => 'félidé'],
                ['nomFamille' => 'cervidé'],
                ['nomFamille' => 'cebidé'],
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
        CategorieAnimalFactory::createOne([
            'nom_categorie' => 'mammifère',
            'descriptionCategorie' => 'description',
        ]);

        $I->amOnPage('/categories');

        $I->click('mammifère description');
        $I->seeResponseCodeIs(200);

        $I->seeCurrentUrlEquals('/families/1');
    }
}
