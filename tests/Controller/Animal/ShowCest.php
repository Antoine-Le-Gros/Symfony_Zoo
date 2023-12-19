<?php

namespace App\Tests\Controller\Animal;

use App\Entity\Animal;
use App\Factory\AnimalFactory;
use App\Factory\CategorieAnimalFactory;
use App\Factory\EnclosFactory;
use App\Factory\EspeceFactory;
use App\Factory\FamilleAnimalFactory;
use App\Factory\RegimeFactory;
use App\Tests\Support\ControllerTester;
use Zenstruck\Foundry\Proxy;

class ShowCest
{
    private function generateAnimalDB(): Proxy|Animal
    {
        RegimeFactory::createOne();
        CategorieAnimalFactory::createOne();
        FamilleAnimalFactory::createOne();
        EnclosFactory::createOne();
        EspeceFactory::createOne();

        return AnimalFactory::createOne();
    }

    public function RedirectIfAnimalNotFound(ControllerTester $I): void
    {
        $I->amOnPage('/animal/1');

        $I->seeCurrentUrlEquals('/animals');
    }

    public function ShowPageIsOk(ControllerTester $I): void
    {
        AnimalFactory::createOne([
            'nomAnimal' => 'Pierre',
            'descriptionAnimal' => 'Pierre est un cailloux',
            'enclos' => EnclosFactory::createOne(['nomEnclos' => 'Le cirque']),
            'espece' => EspeceFactory::createOne(['libEspece' => 'stone']),
        ]);

        $I->amOnPage('/animal/1');

        $I->seeInTitle('Pierre');
        $I->see('Pierre', 'h1');
        $I->see('Pierre', 'dt:contains("Nom :") + dd');
        $I->see('Pierre est un cailloux', 'dt:contains("Description :") + dd');
        $I->see('stone', 'dt:contains("Espèce :") + dd');
        $I->see('Le cirque', 'dt:contains("Enclos :") + dd');
    }
}
