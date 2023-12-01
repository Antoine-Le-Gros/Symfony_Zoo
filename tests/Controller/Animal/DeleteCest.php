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

class DeleteCest
{
    public function formDeleteAnimal(ControllerTester $I): void
    {
        $animal = $this->generateAnimalDB();

        $I->amOnPage("/animal/{$animal->getId()}/delete");
        $I->seeInTitle("Suppression de {$animal->getNomAnimal()}");
        $I->see("Suppression de {$animal->getNomAnimal()}", 'h1');
    }

    public function formDeleteAnimalDenied(ControllerTester $I): void
    {
        $animal = $this->generateAnimalDB();

        $I->amOnPage("/animal/{$animal->getId()}/delete");
        $I->click('#form_cancel');

        $I->seeInCurrentUrl("/animal?id={$animal->getId()}");
        // Changer la ligne du dessus pour celle en dessous pour une fois l'implémentation de la route faite
        // $I->seeCurrentRouteIs('app_animal', ['id' => $animal->getId()]);
    }

    public function generateAnimalDB(): Proxy|Animal
    {
        RegimeFactory::createOne();
        CategorieAnimalFactory::createOne();
        FamilleAnimalFactory::createOne();
        EnclosFactory::createOne();
        EspeceFactory::createOne();

        return AnimalFactory::createOne();
    }
}
