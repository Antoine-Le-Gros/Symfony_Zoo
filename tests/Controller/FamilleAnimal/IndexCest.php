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

    public function clickOnFirstElementOfFamilyList(ControllerTester $I): void
    {
        FamilleAnimalFactory::createOne(
            [
                'nomFamille' => 'canidé',
                'descriptionFamille' => 'description',
                'categorie' => CategorieAnimalFactory::createOne(['nom_categorie' => 'mammifère',
                    'descriptionCategorie' => 'description']),
            ]);
        $I->amOnPage('/families/');
        $I->seeResponseCodeIs(200);
        $I->click('canidé description');
        $I->seeCurrentRouteIs('app_especes');
    }

    public function isListofFamilySorted(ControllerTester $I): void
    {
        $category = CategorieAnimalFactory::createOne(['nom_categorie' => 'mammifère',
            'descriptionCategorie' => 'description']);
        FamilleAnimalFactory::createSequence(
            [
                ['nomFamille' => 'homnidé',
                    'descriptionFamille' => 'description',
                    'categorie' => $category,
                ],

                ['nomFamille' => 'bovidé',
                    'descriptionFamille' => 'description',
                    'categorie' => $category,
                ],

                ['nomFamille' => 'félidé',
                    'descriptionFamille' => 'description',
                    'categorie' => $category,
                ],

                ['nomFamille' => 'cerbidé',
                    'descriptionFamille' => 'description',
                    'categorie' => $category,
                ],
            ]
        );
        $I->amOnPage('/families/');
        $I->seeResponseCodeIs(200);
        $I->assertEquals(['bovidé description',
                          'cerbidé description',
                          'félidé description',
                          'homnidé description',
                        ],
            $I->grabMultiple('.famillesAnimal li'));
    }
}
