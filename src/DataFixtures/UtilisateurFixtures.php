<?php

namespace App\DataFixtures;

use App\Factory\UtilisateurFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
;

class UtilisateurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UtilisateurFactory::createMany(20,function (){
            $bool=UtilisateurFactory::faker()->boolean(15);
            return [
                'dateEmbauche'=>$bool ? UtilisateurFactory::faker()->datetime() : null,
                'dureeContrat'=>$bool ? UtilisateurFactory::faker()->numberBetween(1,365): null,
                'roles'=>$bool ? ['ROLE_PERSONNEL'] :['ROLE_UTULISATEUR'],
            ];

        });

        UtilisateurFactory::createOne([
            'pnomUser'=>'Pierre',
            'nomUser'=>'Gouedar',
            'roles'=>['ROLE_ADMIN']
        ]);

    }
}
