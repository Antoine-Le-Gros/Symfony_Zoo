<?php

namespace App\Tests\Controller\CategorieAnimal;

use App\Factory\CategorieAnimalFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function defaultNumberOfCategorieAnimalIs10(ControllerTester $I): void
    {
        CategorieAnimalFactory::createMany(10);

        $I->amOnPage('/categories');
        $I->seeResponseCodeIs(200);

        $I->seeInTitle('Liste des catégories présentes au sein du zoo');
        $I->see('Liste des catégories présentes au sein du zoo', 'h1');
        $I->seeNumberOfElements('.categoriesAnimal>li>a[href]', 10);
    }

    public function clickOnFirstElementOfCategoryList(ControllerTester $I): void
    {
        CategorieAnimalFactory::createOne([
            'nom_categorie' => 'reptile',
            'descriptionCategorie' => 'description',
        ]);

        $I->amOnPage('/categories');

        $I->click('reptile description');
        $I->seeResponseCodeIs(200);

        $I->seeCurrentUrlEquals('/families/1');
    }

    public function isCategoryListSorted(ControllerTester $I): void
    {
        CategorieAnimalFactory::createSequence(
            [
                [
                    'nom_categorie' => 'amphibien',
                    'descriptionCategorie' => 'description',
                ],
                [
                    'nom_categorie' => 'reptile',
                    'descriptionCategorie' => 'description',
                ],
                [
                    'nom_categorie' => 'mammifère',
                    'descriptionCategorie' => 'description',
                ],
                [
                    'nom_categorie' => 'oiseau',
                    'descriptionCategorie' => 'description',
                ],
            ]
        );

        $I->amOnPage('/categories');

        $I->assertEquals(
            [
                'amphibien description',
                'mammifère description',
                'oiseau description',
                'reptile description',
            ],
            $I->grabMultiple('.categoriesAnimal li>a')
        );
    }

    public function testSearchCategory(ControllerTester $I): void
    {
        CategorieAnimalFactory::createSequence(
            [
                [
                    'nom_categorie' => 'amphibien',
                    'descriptionCategorie' => 'description',
                ],
                [
                    'nom_categorie' => 'reptile',
                    'descriptionCategorie' => 'description',
                ],
                [
                    'nom_categorie' => 'mammifère',
                    'descriptionCategorie' => 'description',
                ],
                [
                    'nom_categorie' => 'oiseau',
                    'descriptionCategorie' => 'description',
                ],
            ]
        );

        $I->amOnPage('/categories?search=am');

        $I->assertEquals(
            [
                'amphibien description',
                'mammifère description',
            ],
            $I->grabMultiple('.categoriesAnimal li>a')
        );
    }
}
