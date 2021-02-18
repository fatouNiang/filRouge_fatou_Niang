<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Referentiel;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ReferentielFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $fake= Factory::create('FR_fr');
        for($i=1;$i<=2;$i++)
        {
            $referenciel = new Referentiel();

            $referenciel->setLibelle('libelle'.$i)
                        ->setCriteraAdmission('critere d\'admission '.$i)
                         ->setCritereEvaluation('critere evaluation '.$i)
                         ->setLibelle('referentiel'.$i)
                         ->setPresentation($fake->text)
                         ->setProgramme('programme '.$i);

             //$tab_referentiel[]=$referenciel;
            $manager->persist($referenciel);
        }

        $manager->flush();
    }
}
