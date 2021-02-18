<?php

namespace App\DataFixtures;

use App\Entity\Competences;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CompetencesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=0; $i <5 ; $i++) { 
            $comp= new Competences(); 
            $comp->setLibelle("libelle".$i);
            $manager->persist($comp);
        }

        $manager->flush();
    }
}
