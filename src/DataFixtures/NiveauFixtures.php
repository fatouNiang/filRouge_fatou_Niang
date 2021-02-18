<?php

namespace App\DataFixtures;

use App\Entity\Niveau;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class NiveauFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        for($i=1;$i<=3;$i++)
        {
            $niveau=new Niveau();
            $niveau->setLibelle('niveau '.$i)
                    ->setCritereEvaluation('critere_evaluation '.$i);
            //$niveau->setGroupeAction('competentence '.$i.'groupe action '.$j);
            //$niveau->setCompetence($competence);
            //$niveau->setBrief($brief);
            $manager->persist($niveau);
        }

            //$manager->persist($product);

        $manager->flush();
    }
}
