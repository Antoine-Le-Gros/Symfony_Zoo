<?php

namespace App\Tests\Controller\Animal;

use App\Entity\Animal;
use App\Factory\AnimalFactory;
use App\Tests\Support\ControllerTester;

class DeleteCest
{
    public function formDeleteAnimal(ControllerTester $I): void
    {
        AnimalFactory::createOne([
            'nomAnimal' => 'Pierre',
            'descriptionAnimal' => 'Pierre est un cailloux',
        ]);

        $I->amOnPage('/animal/1/delete');

        $I->seeInTitle('Suppression de Pierre');
        $I->see('Suppression de Pierre', 'h1');
    }

    public function formDeleteAnimalDenied(ControllerTester $I): void
    {
        AnimalFactory::createOne([
            'nomAnimal' => 'Pierre',
            'descriptionAnimal' => 'Pierre est un cailloux',
        ]);

        $I->amOnPage('/animal/1/delete');
        $I->click('Annuler');

        $I->seeCurrentUrlEquals('/animal/1');
    }

    public function formDeleteAnimalAccepted(ControllerTester $I): void
    {
        AnimalFactory::createOne([
            'nomAnimal' => 'Pierre',
            'descriptionAnimal' => 'Pierre est un cailloux',
        ]);

        $I->amOnPage('/animal/1/delete');

        $I->click('Supprimer');

        $I->seeInCurrentUrl('/animals');
        $I->dontSeeInRepository(Animal::class, [
            'nomAnimal' => 'Pierre',
            'descriptionAnimal' => 'Pierre est un cailloux',
        ]);
    }
}
