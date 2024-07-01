<?php declare(strict_types=1);


use App\Entity\Ingredient;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;


final class IngredientTest extends TestCase{



public function testGetName()
    {

      $ingredient = new Ingredient();
      $ingredient->setName('Eau'); // Supposons que setName est un setter disponible
      $name = $ingredient->getName();

      $this->assertSame('Eau', $name);
    }

    
    public function testGetPrice(){
      $ingredient = new Ingredient();
      $ingredient->setPrice(1.5); 
      $price = $ingredient->getPrice();
      $this->assertSame(1.5, $price);
    }

    public function testSetName()
    {
       $ingredient = new Ingredient();
       $ingredient->setName('carotte');
       $name = $ingredient->getName();
       $this->assertSame('carotte', $name);
    }

    public function testGetCreatedAt()
    {
       $ingredient = new Ingredient();
       $createdAt = $ingredient->getCreatedAt();
       $this->assertInstanceOf(\DateTimeImmutable::class, $createdAt);
    }

  public function test__construct()
  {
    $ingredient = new Ingredient();
    $this->assertNotEmpty($ingredient->getCreatedAt());
 
    $this->assertEmpty($ingredient->getRecettes());
  }


  

  public function testAddRecettes(){

    $ingredient = new Ingredient();
    $recette = $this->createMock(\App\Entity\Recettes::class);
    $ingredient->addRecettes($recette);
    $this->assertCount(1, $ingredient->getRecettes());

    }

   public function testRemoveRecettes(){
    $ingredient = new Ingredient();
    $recette = $this->createMock(\App\Entity\Recettes::class);
    $ingredient->addRecettes($recette);
    $ingredient->removeRecettes($recette);
    $this->assertCount(0, $ingredient->getRecettes());
   }

    public function testToString(){
    $ingredient = new Ingredient();
    $ingredient->setName('Eau');
    $this->assertSame('Eau', (string) $ingredient);
    }

    public function testGetUser(){
    $ingredient = new Ingredient();
    $user = $this->createMock(\App\Entity\User::class);
    $ingredient->setUser($user);
    $this->assertSame($user, $ingredient->getUser());
    }
    public function testSetUser(){
      $ingredient = new Ingredient();
      $user = $this->createMock(\App\Entity\User::class);
      $ingredient->setUser($user);
      $this->assertSame($user, $ingredient->getUser());

      $ingredient->setUser(null);
      $this->assertNull($ingredient->getUser());
   
   
 }

 public function testGetId(){
   $ingredient = new Ingredient();
   $id = $ingredient->getId();
   $this->assertNull($id);
 }


    
} 