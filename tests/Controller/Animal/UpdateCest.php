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
    /*
    public function accessIsRestrictedForNoAdmin(ControllerTester $I): void
    {
        $I->amOnPage('/animal/create');
        $I->amOnRoute('app_login');
    }
 */

    public function formUpdateAnimal(ControllerTester $I): void
    {
        // $adminUser = UtilisateurFactory::createOne(['roles' => ['ROLE_ADMIN']])->object();
        // $I->amLoggedInAs($adminUser);

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
        // $adminUser = UtilisateurFactory::createOne(['roles' => ['ROLE_ADMIN']])->object();
        // $I->amLoggedInAs($adminUser);

        AnimalFactory::createOne([
            'nomAnimal' => 'Pierre',
            'descriptionAnimal' => 'Pierre est un cailloux',
            'enclos' => EnclosFactory::createOne(['nomEnclos' => 'Le cirque']),
            'espece' => EspeceFactory::createOne(['libEspece' => 'stone']),
        ]);

        $I->amOnPage('/animal/1/update');

        $this->generateAnimalDB();
        $I->fillField('Nom de l\'animal', 'Antoine');
        $I->fillField('Description de l\'animal', 'Antoine le go muscu');
        $I->click('Modifier');

        $I->seeCurrentUrlEquals('/animal/1');
        $I->SeeInRepository(Animal::class, [
            'nomAnimal' => 'Antoine',
            'descriptionAnimal' => 'Antoine le go muscu',
            'espece' => [
                'libEspece' => 'stone',
            ],
            'enclos' => [
                'nomEnclos' => 'Le cirque',
            ],
        ]);
    }
}
