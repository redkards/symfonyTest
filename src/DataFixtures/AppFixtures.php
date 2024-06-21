<?php

namespace App\DataFixtures;

use Faker\Generator;
use Faker\Factory;
use App\Entity\Ingredient;
use App\Entity\Recettes;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;



class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    private Generator $faker;

public function __construct(UserPasswordHasherInterface $hasher){
   
    $this->faker = Factory::create('fr_FR');
    $this->hasher = $hasher;
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
    $recette = new Recettes();
    $recette -> setName($this->faker->word())
    -> setTime(mt_rand(1,1440))
    -> setNbPeople(mt_rand(0,1)==1? mt_rand(0,50) : null)
    -> setDifficulty(mt_rand(0,1)==1? mt_rand(1,5) : null)
    ->setDescription($this->faker->text(300))
    ->setPrice(mt_rand(0,1)==1? mt_rand(1,1000) : null)
    ->setisFavorite(mt_rand(0,1)==1? true:false);

for ($k=0; $k < mt_rand(5,15) ; $k++) {
    $recette->addIngredient($ingredients[mt_rand(0,count($ingredients)-1)]);
}

    $manager->persist($recette);
   }

   //Users

   for($i=0; $i<10 ; $i++) {
    $user = new User();
    $user ->setName($this->faker->name())
    ->setPseudo(mt_rand(0,1)===1 ? $this -> faker->firstName():null)
    ->setEmail($this->faker->email())
    ->setPassword('password')
    ->setRoles(['ROLE_USER'])
    ->setPlainPassword("password");

    

    $manager->persist($user);
}
   


$manager->flush();

    }
}
