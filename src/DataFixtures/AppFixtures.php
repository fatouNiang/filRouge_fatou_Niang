<?php

namespace App\DataFixtures;

//use Faker\Factory;
use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        // $product = new Product();

        //$manager->persist();

        //$manager->flush();
    }
}
