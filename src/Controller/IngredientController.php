<?php

namespace App\Controller;



use App\Entity\Ingredient;
use App\Form\IngredientType;
use App\Repository\IngredientRepository;

use Doctrine\ORM\EntityManagerInterface ;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IngredientController extends AbstractController
{
   /**
    * this function display all ingredients
    *
    * @param IngredientRepository $ingredientRepository
    * @param PaginatorInterface $paginator
    * @param Request $request
    * @return Response
    */
    #[Route('/ingredient', name: 'app_ingredient',methods:['GET'])]
    public function index(IngredientRepository $ingredientRepository,PaginatorInterface $paginator,Request $request): Response
    {
       
        $ingredients = $paginator->paginate(
            $ingredientRepository->findBy(['user'=>$this->getUser()]),
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('pages/ingredient/index.html.twig', [
            'ingredients' => $ingredients
        ]);
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @param ORMEntityManagerInterface $manager
     * @return Response
     */
    #[Route('/ingredient/nouveau/', name: 'app_ingredient_new',methods:['GET', 'POST'])]
    public function new(Request $request,EntityManagerInterface $manager):Response
    {

        $ingredient = new Ingredient ();

        $form = $this->createForm(IngredientType::class, $ingredient);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
        $ingredient = $form->getData();
        $ingredient->setUser($this->getUser());


        $manager->persist($ingredient);
        $manager->flush();

        $this->addFlash('success', 'votre ingrédient a bien été ajouté');
        return $this->redirectToRoute('app_ingredient');
        }

        return $this->render('pages/ingredient/new.html.twig',
         ['form' => $form -> createView()]
        );
    }
    #[route('/ingredient/edition/{id}','app_ingredient_edit', methods:['GET', 'POST'])]
    public function edit(IngredientRepository $ingredientRepository, int $id,Request $request,EntityManagerInterface $manager) :Response {

        $ingredient = $ingredientRepository->findOneBy(["id" => $id]);
        $form = $this->createForm(IngredientType::class, $ingredient);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
        $ingredient = $form->getData();
        $manager->persist($ingredient);
        $manager->flush();
        $this->addFlash('success', 'votre ingrédient a bien été ajouté');
        return $this->redirectToRoute('app_ingredient');
        }

        return $this->render('pages/ingredient/edit.html.twig',[
            'form' =>$form->createView()
    ]);
}
#[Route('/ingredient/suppression/{id}', 'app_ingredient_delete', methods: ['GET'])]
public function delete(IngredientRepository $ingredientRepository, int $id,Request $request,EntityManagerInterface $manager) :Response {

    $ingredient = $ingredientRepository->findOneBy(["id" => $id]);

if(!$ingredient){
    $this->addFlash(
        'success',
        "votre ingrédient n'a pas été trouvé !"
    );
    return $this->redirectToRoute('app_ingredient');
}

    $manager->remove($ingredient);
    $manager->flush();
    $this->addFlash('success', 'votre ingrédient a bien été supprimé');
    return $this->redirectToRoute('app_ingredient');
}
}