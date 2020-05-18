<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {   $faker= Factory::create('fr_FR');
        for ($i=0;$i<100;$i++)
        {
            $proprety= new Property();
            $proprety
                ->setTitle($faker->words(3, true))
                ->setDescription($faker->sentences(3,true))
                ->setSurface($faker->numberBetween(9,347))
                ->setRoom($faker->numberBetween(2,10))
                ->setBedroom($faker->numberBetween(1,6))
                ->setFloor($faker->randomDigit)
                ->setPrice($faker->numberBetween(11000,75000))
                ->setHeat($faker->numberBetween(0,count(Property::HEAT)-1))
                ->setCity($faker->city)
                ->setAddress($faker->address)
                ->setPostalCode($faker->postcode)
                ->setSold(false);

            $manager->persist($proprety);

        }
        // $product = new Product();
      
        $manager->flush();
    }
}
