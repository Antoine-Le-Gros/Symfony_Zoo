<?php

namespace App\Tests\Controller\FamilleAnimal;

use App\Factory\CategorieAnimalFactory;
use App\Factory\FamilleAnimalFactory;
use App\Tests\Support\ControllerTester;

class IndexCest
{
    public function DefaultNumberOfFamilyIs10(ControllerTester $I): void
    {
        CategorieAnimalFactory::createMany(5);
        FamilleAnimalFactory::createMany(10, ['categorie' => CategorieAnimalFactory::random()]);
        $I->amOnPage('/families/');
        $I->seeResponseCodeIs(200);
        $I->seeInTitle('Liste des familles');
        $I->see('Liste des familles ', 'h1');
        $I->seeNumberOfElements('.famillesAnimal li>a[href]', 10);
    }

}
