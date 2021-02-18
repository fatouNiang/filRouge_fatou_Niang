<?php

namespace App\DataFixtures;

use App\Entity\GroupeCompetence;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class GroupeCompetencesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        for ($i=0; $i <5 ; $i++) { 
            $Grpcomp= new GroupeCompetence(); 
            $Grpcomp->setLibelle("libelle".$i)
                    ->setDescription("description".$i);
            $manager->persist($Grpcomp);
        }

        $manager->flush();
    }
}
