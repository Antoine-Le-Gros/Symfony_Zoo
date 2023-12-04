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

    public function ShowPageIsOk(ControllerTester $I): void
    {
        $animal = $this->generateAnimalDB();
        $I->amOnRoute('app_animal_show', ['id' => $animal->getId()]);
        $I->seeInTitle($animal->getNomAnimal());
        $I->see($animal->getNomAnimal(), 'h1');
        $I->see($animal->getNomAnimal(), 'dl dt:nth-child(1) + dd');
        $I->see($animal->getDescriptionAnimal(), 'dl dt:nth-child(3) + dd');
        $I->see($animal->getEspece()->getLibEspece(), 'dl dt:nth-child(5) + dd');
        $I->see($animal->getEnclos()->getNomEnclos(), 'dl dt:nth-child(7) + dd');
    }
}
