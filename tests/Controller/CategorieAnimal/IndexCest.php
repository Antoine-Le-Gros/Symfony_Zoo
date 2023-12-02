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
        CategorieAnimalFactory::createOne(['nom_categorie' => 'reptile',
                                                  'descriptionCategorie' => 'description',
                                            ]);
        $I->amOnPage('/categories');
        $I->click('reptile description');
        $I->seeResponseCodeIs(200);
        $I->seeCurrentRouteIs('app_families');
    }
}
