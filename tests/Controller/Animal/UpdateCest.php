<?php

namespace App\Tests\Controller\Animal;

use App\Factory\AnimalFactory;
use App\Factory\CategorieAnimalFactory;
use App\Factory\EnclosFactory;
use App\Factory\EspeceFactory;
use App\Factory\FamilleAnimalFactory;
use App\Factory\RegimeFactory;
use App\Tests\Support\ControllerTester;

class UpdateCest
{
    public function formUpdateAnimal(ControllerTester $I): void
    {
        $this->generateAnimalDB();

        $I->amOnRoute('app_animal_update', ['id' => 1]);
        $I->seeInTitle('Édition de Pierre');
        $I->see('Édition de Pierre', 'h1');
        $I->seeInField('input[name="animal[nomAnimal]"]', 'Pierre');
        $I->seeInField('input[name="animal[descriptionAnimal]"]', 'Pierre est un cailloux');
        $I->seeOptionIsSelected('select[name="animal[espece]"]', 'stone');
        $I->seeOptionIsSelected('select[name="animal[enclos]"]', 'Le cirque');
    }

    public function FormUpdateAnimalSend(ControllerTester $I): void
    {
        $this->generateAnimalDB();

        $I->amOnRoute('app_animal_update', ['id' => 1]);
        $I->submitForm('form', [], 'Créer');
        $I->amOnRoute('app_animal_show', ['id' => 1]);
    }

    private function generateAnimalDB(): void
    {
        RegimeFactory::createOne();
        CategorieAnimalFactory::createOne();
        FamilleAnimalFactory::createOne();
        $enclos = EnclosFactory::createOne(['nomEnclos' => 'Le cirque']);
        $espece = EspeceFactory::createOne(['libEspece' => 'stone']);
        AnimalFactory::createOne([
            'nomAnimal' => 'Pierre',
            'descriptionAnimal' => 'Pierre est un cailloux',
            'espece' => $espece,
            'enclos' => $enclos,
        ]);
    }
}
