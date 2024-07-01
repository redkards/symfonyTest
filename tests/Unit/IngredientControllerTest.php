<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Entity\Ingredient;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IngredientControllerTest extends WebTestCase

{

    public function testIndex(): void
    {
        //créer le client
        $client = static::createClient();
        //vérif de la route de login pour se connecter
        $crawler = $client->request('GET', '/login');
        //remplir le formulaire de login
        $form = $crawler->selectButton('login')->form([
            '_username' => 'veronique64@tele2.fr',
            '_password' => 'password',
        ]);


        //soumettre le formulaire
        $client->submit($form);
        //vérif de la redirection
        $this->assertResponseRedirects();
        //suivre la redirection
        $client->followRedirect();
        //vérif de la route de la page d'ingrédients
        $client->request('GET', '/ingredient');
        //vérif de la réponse
        $this->assertResponseIsSuccessful();
        //vérif de la présence du titre
        $this->assertSelectorTextContains('h1', 'Mes ingrédients');
    }


}