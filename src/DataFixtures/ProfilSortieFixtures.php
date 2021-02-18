<?php

namespace App\DataFixtures;

use App\Entity\ProfilSortie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProfilSortieFixtures extends Fixture
{
    public static function getReferenceKey($i){
        return sprintf('profilSortie_user_%s',$i);
    }

    public function load(ObjectManager $manager)
    {
        
        //public const REFERENCE

        $TabprofilSorti=["front-end", "back_end", "CMS", "java", "php"];

        for ($i=0; $i <5 ; $i++) { 
           $pSorti= new ProfilSortie();
           $pSorti->setLibelle($TabprofilSorti[$i]);
                //->setArchivage(false);
          $manager->persist($pSorti);
          $this->addReference(self::getReferenceKey($i),$pSorti);

        }
        // $product = new Product();
        

        $manager->flush();
    }
}
