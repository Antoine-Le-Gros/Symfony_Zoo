<?php

namespace Controller\AnimalCategory;

use App\Factory\AnimalCategoryFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function defaultNumberOfAnimalCategoryIs10(ControllerTester $I): void
    {
        AnimalCategoryFactory::createMany(10);

        $I->amOnPage('/categories');
        $I->seeResponseCodeIs(200);

        $I->seeInTitle('Liste des catégories présentes au sein du zoo');
        $I->see('Liste des catégories présentes au sein du zoo', 'h1');
        $I->seeNumberOfElements('ul.container>li.card', 10);
    }

    public function clickOnFirstElementOfCategoryList(ControllerTester $I): void
    {
        AnimalCategoryFactory::createOne([
            'name' => 'reptile',
            'description' => 'description',
        ]);

        $I->amOnPage('/categories');

        $I->click('reptile description');
        $I->seeResponseCodeIs(200);

        $I->seeCurrentUrlEquals('/families/1');
    }

    public function isCategoryListSorted(ControllerTester $I): void
    {
        AnimalCategoryFactory::createSequence(
            [
                [
                    'name' => 'amphibien',
                    'description' => 'description',
                ],
                [
                    'name' => 'reptile',
                    'description' => 'description',
                ],
                [
                    'name' => 'mammifère',
                    'description' => 'description',
                ],
                [
                    'name' => 'oiseau',
                    'description' => 'description',
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
        AnimalCategoryFactory::createSequence(
            [
                [
                    'name' => 'amphibien',
                    'description' => 'description',
                ],
                [
                    'name' => 'reptile',
                    'description' => 'description',
                ],
                [
                    'name' => 'mammifère',
                    'description' => 'description',
                ],
                [
                    'name' => 'oiseau',
                    'description' => 'description',
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
