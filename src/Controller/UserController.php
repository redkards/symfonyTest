<?php

namespace App\Controller;

use App\Form\UserType;
use App\Form\UserPasswordType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;


class UserController extends AbstractController
{
        /**
     * this controller allow to update the name and the pseudo of user
     * 
     * @param User $user
     * @param Request $request
     * @param EntityManager $entityManager
     * @return Response
     * 
     */

    #[Route('/utilisateur/edition/{id}', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(UserRepository $userRepository, int $id,Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher): Response
    {

$user = $userRepository->findOneBy(["id" => $id]);
// vérif si le user est connecté

if(!$this->getUser()) {
    return $this->redirectToRoute('app_login');


        return $this->render('pages/user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }


//verif si le user connecté est le même que nous avons récupéré

if($this->getUser() !==$user){
    return  $this->redirectToRoute('app_recettes');
}

//création du formulaire 

$form = $this->createForm(UserType::class,$user);

$form->handleRequest($request);

if($form->isSubmitted() && $form->isValid()){

    if ($user instanceof PasswordAuthenticatedUserInterface) {
    if($hasher->isPasswordValid($user, $form->getData()->getPlainPassword())){
        
        $user = $form->getData();

$manager->persist($user);
$manager->flush();

$this->addFlash(
   'success', 
    'les informations de votre compte ont bien été modifiées');

    return $this->redirectToRoute('app_recettes');
}

else{
    $this->addFlash(
        'warning',
        'le mot de passe est incorrect'
    );
}}


    $user = $form->getData();

    $manager->persist($user);
    $manager->flush();
    
    $this->addFlash(
        'success', 
        'les informations de votre compte ont bien été modifiées');

    return $this->redirectToRoute('app_recettes');
}

return $this->render('pages/user/edit.html.twig',[
    'form' => $form->createView()
]);
    

}

#[Route('/utilisateur/edition-mot-de-passe/{id}', name: 'user_edit_password', methods:['GET','POST'])]
public function editPassword(UserRepository $userRepository, int $id,Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher):Response{
    
    //recupération du user par son id

    $user = $userRepository->findOneBy(["id" => $id]);
    $form = $this->createForm(UserPasswordType::class);

    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid()){
        if($hasher->isPasswordValid($user, $form->getData()['plainPassword'])){

            $user->setPassword(
                $hasher->hashPassword(
                    $user,
                    $form->getData()['newPassword']
                )
                );
                $manager->persist($user);
                $manager->flush();

$this->addFlash(
    'success',
    'le mot de passe a bien été modifié'
);
return $this->redirectToRoute('app_recettes');

        }else{
            $this->addFlash(
                'warning',
                'le mot de passe renseigné est incorrect'
            );
        }
    }
    return $this->render('pages/user/edit_password.html.twig',[
        'form'=> $form->createView()
    ]);
}
}



    




