<?php

namespace App\Controller;


use App\Entity\Recettes;
use App\Form\RecettesType;
use App\Repository\RecettesRepository;

use Doctrine\ORM\EntityManagerInterface ;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecettesController extends AbstractController
{
   /**
    * this function display all recettes
    *
    * @param RecettesRepository $recettesRepository
    * @param PaginatorInterface $paginator
    * @param Request $request
    * @return Response
    */
    #[Route('/recettes', name: 'app_recettes',methods:['GET'])]
    public function index(RecettesRepository $recettesRepository,PaginatorInterface $paginator,Request $request): Response
    {
       
        $recettes = $paginator->paginate(
            $recettesRepository->findAll(),
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('pages/recettes/index.html.twig', [
            'recettes' => $recettes
        ]);
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @param ORMEntityManagerInterface $manager
     * @return Response
     */
    #[Route('/recettes/creation', name: 'app_recettes_new',methods:['GET', 'POST'])]
    public function new(Request $request,EntityManagerInterface $manager):Response
    {

        $recettes = new Recettes ();

        $form = $this->createForm(RecettesType::class, $recettes);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
        $recettes = $form->getData();

        $manager->persist($recettes);
        $manager->flush();

        return $this->redirectToRoute('app_recettes');
    }
    $this->addFlash('success', 'votre recette a bien été ajoutée');

        return $this->render('pages/recettes/new.html.twig',
         ['form' => $form -> createView()]
        );
    }
    #[route('/recettes/edition/{id}','app_recettes_edit', methods:['GET', 'POST'])]
    public function edit(RecettesRepository $recettesRepository, int $id,Request $request,EntityManagerInterface $manager) :Response {

        $recettes = $recettesRepository->findOneBy(["id" => $id]);
        $form = $this->createForm(RecettesType::class, $recettes);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
        $recettes = $form->getData();

        $manager->persist($recettes);
        $manager->flush();

        $this->addFlash('success', 'votre recette a bien été modifiée');
        return $this->redirectToRoute('app_recettes');
    }

        return $this->render('pages/recettes/edit.html.twig',[
            'form' =>$form->createView()
    ]);
}
#[Route('/recettes/suppression/{id}', 'app_recettes_delete', methods: ['GET'])]
public function delete(RecettesRepository $recettesRepository, int $id,Request $request,EntityManagerInterface $manager) :Response {

    $recettes = $recettesRepository->findOneBy(["id" => $id]);

if(!$recettes){
    $this->addFlash(
        'success',
        "votre recette n'a pas été trouvé !"
    );
    return $this->redirectToRoute('app_recettes');
}

    $manager->remove($recettes);
    $manager->flush();

    $this->addFlash('success', 'votre recette a bien été supprimé');

    return $this->redirectToRoute('app_recettes');
}
}