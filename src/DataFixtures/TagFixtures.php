<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TagFixtures extends Fixture 
{

    public static function getReferenceKey($i){
        return sprintf('Tag_%s',$i);
    }
    public function load(ObjectManager $manager)
    {
        $tags=["php", "java", "html", "css", "angular"];

        for ($i=0; $i <5 ; $i++) { 
           $Tag= new Tag();
           $Tag->setLibelle($tags[$i]);
                //->setArchivage(false);
          $manager->persist($Tag);
          $this->addReference(self::getReferenceKey($i),$Tag);

        }        
 
        $manager->flush();
    }
} 
