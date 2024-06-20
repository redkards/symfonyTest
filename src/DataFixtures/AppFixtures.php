<?php

namespace App\DataFixtures;

use Faker\Generator;
use Faker\Factory;
use App\Entity\Ingredient;
use App\Entity\Recette;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;



class AppFixtures extends Fixture
{


    
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {

        //data ingredient
        $ingredient =[];
        for ($i=0; $i<50 ; $i++){
       $ingredient = new Ingredient();
       $ingredient ->setName($this->faker->word())
                   ->setPrice(mt_rand(0,100));
                   $ingredients[] = $ingredient;
                   
         $manager->persist($ingredient);
        }
   //data recette
   for ($j=0; $j <25; $j++){
    $recette = new Recette();
    $recette -> setName($this->faker->word())
    -> setTime(mt_rand(1,1440))
    -> setNbPeople(mt_rand(0,1)==1? mt_rand(0,50) : null)
    -> setDifficulty(mt_rand(0,1)==1? mt_rand(1,5) : null)
    ->setDescription($this->faker->text(300))
    ->setPrice(mt_rand(0,1)==1? mt_rand(1,1000) : null)
    ->setIsFavorite(mt_rand(0,1)==1? true:false);

   }


$manager->flush();
    }
}
