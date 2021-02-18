<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Groupes;
use Faker\Provider\DateTime;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GroupeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $Groupes=["groupe1","groupe2", "groupe3","groupe4","groupe5"];
        // $faker = Factory::create('fr-FR');

        // for ($i=0; $i <5 ; $i++) { 
        //     $Groupe= new Groupes();
        //     $Groupe->setNom($Groupes[$i])
        //             ->setDateCreation(new DateTime()  ) 
        //             ->setStatut("enCours")
        //             ->setType("filRouge");

        //          $manager->persist($Groupe);

        // }

        $manager->flush();
    }
}
