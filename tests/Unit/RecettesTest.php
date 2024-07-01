<?php declare(strict_types=1);

use App\Entity\Ingredient;
use App\Entity\Recettes;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;


final class RecettesTest extends TestCase{

    public function testGetId(){
        $recette = new Recettes();
        $id = $recette->getId();
        $this->assertNull($id);
      }

      public function testSetName(){
        $recette = new Recettes();
        $recette->setName('Salade de pommes'); // Supposons que setName est un setter disponible
        $name = $recette->getName();
        $this->assertEquals('Salade de pommes', $name);
      }

      public function testGetUser(){
        $user = new User();
        $recette = new Recettes();
        $recette->setUser($user);
        $this->assertEquals($user, $recette->getUser());
      }

     public function testSetTime(){
        $recette = new Recettes();
        $time = 20; // Supposons que setTime est un setter disponible
        $recette->setTime($time);
        $this->assertEquals(20, $recette->getTime());
 
     }

     public function testGetNbPeople(){
        $recette = new Recettes();
        $nbPeople = 4; // Supposons que setNbPeople est un setter disponible
        $recette->setNbPeople($nbPeople);
        $this->assertEquals(4, $recette->getNbPeople());

}

     public function testGetDifficulty(){
        $recette = new Recettes();
        $difficulty = 3; // Supposons que setDifficulty est un setter disponible
        $recette->setDifficulty($difficulty);
        $this->assertEquals(3, $recette->getDifficulty());
     }

     public function testGetDescription(){
        $recette = new Recettes();
        $description = 'Une recette de salade de pommes'; // Supposons que setDescription est un setter disponible
        $recette->setDescription($description);
        $this->assertEquals('Une recette de salade de pommes', $recette->getDescription());
     }

     public function testGetPrice(){
        $recette = new Recettes();
        $price = 15; // Supposons que setPrice est un setter disponible
        $recette->setPrice($price);
        $this->assertEquals(15, $recette->getPrice());
     }

    

     public function testGetCreatedAt(){
        $recette = new Recettes();
        $createdAt = $recette->getCreatedAt();
        $this->assertNotNull($createdAt);
     }

     
     public function testSetCreatedAt(){

       $recette = new Recettes();
       $createdAt = new \DateTimeImmutable(); // Supposons que setCreatedAt est un setter disponible
       $recette->setCreatedAt($createdAt);
       $this->assertEquals($createdAt, $recette->getCreatedAt());
     }

     
     public function testSetUpdatedAt(){
       $recette = new Recettes();
       $updatedAt = new \DateTimeImmutable(); // Supposons que setUpdatedAt est un setter disponible
       $recette->setUpdatedAt($updatedAt);
       $this->assertEquals($updatedAt, $recette->getUpdatedAt());
     }

     

     public function testSetIsFavorite(){
       $recette = new Recettes();
       $isFavorite = false; // Supposons que setIsFavorite est un setter disponible
       $recette->setIsFavorite($isFavorite);
       $this->assertEquals(false, $recette=$isFavorite);
     }
     
     public function test__construct(){ 
       $recette = new Recettes();
       $ingredient = $this->createMock(\App\Entity\Ingredient::class);
       $recette->addIngredient($ingredient);


       $this->assertEquals(1, $recette->getIngredient()->count());  
       $this->assertNotNull($recette->getCreatedAt());
       $this->assertNotNull($recette->getUpdatedAt());
   
      
      
     }

      public function testGetIngredient(){
         $ingredient = $this->createMock(\App\Entity\Ingredient::class);
         $ingredient = new Ingredient();
         $recette = new Recettes();
         $recette->addIngredient($ingredient);
         $this->assertEquals(1, $recette->getIngredient()->count());
      
     
     }
     
     public function testAddIngredient(){
      $ingredient = $this->createMock(\App\Entity\Ingredient::class);
        $ingredient = new Ingredient();
        $recette = new Recettes();
        $recette->addIngredient($ingredient);
        $this->assertEquals(1, $recette->getIngredient()->count());
     }
     
     public function testRemoveIngredient(){
      $ingredient = $this->createMock(\App\Entity\Ingredient::class);
        $ingredient = new Ingredient();
        $recette = new Recettes();
        $recette->addIngredient($ingredient);
        $recette->removeIngredient($ingredient);
        $this->assertEquals(0, $recette->getIngredient()->count());
     }
     
      

       public function testSetUser(){
         $user = $this->createMock(\App\Entity\User::class);
         $recette = new Recettes();
         $recette->setUser($user);
         $this->assertEquals($user, $recette->getUser());
       }
      

     


   }



   