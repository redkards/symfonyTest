<?php

namespace App\Form;

use App\Entity\ingredient;
use App\Entity\Recettes;
use App\Repository\IngredientRepository;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Constraints as Assert;


class RecettesType extends AbstractType
{
    private $token;

    public function __construct(TokenStorageInterface $token){
        $this->token = $token;
    }


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'attr'=>[
                    'class' => 'form-control',
                    'minlength' => 2,
                    'maxlength' => 50,                  
                ]
            ])
            ->add('time',IntegerType::class,[
                'attr'=>[
                    'class' => 'form-control',
                    'minlength' => 2,
                    'maxlength' => 1440,                  
                ],
                'label' => 'Temps (en minutes)',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Positive(),
                    new Assert\LessThan(1441)
                ]
            ])
            ->add('nbPeople',IntegerType::class,[
                'attr'=>[
                    'class' => 'form-control',
                    'minlength' => 2,
                    'maxlength' => 50,                  
                ],
                'required' =>false,
                'label' => 'Nombre de personnes',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Positive(),
                    new Assert\LessThan(51)
                ]
            ])
            ->add('difficulty',RangeType::class,[
                'attr'=>[
                    'class' => 'form-control',
                    'min' => 1,
                    'max' => 5,                  
                ],
                'required' =>false,
                'label' => 'Difficulté',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Positive(),
                    new Assert\LessThan(5)
                ]
            ])
            ->add('description',TextareaType::class,[
                'attr'=>[
                    'class' => 'form-control',
                    'min' => 1,
                    'max' => 5,                  
                ],
                'label' => 'Description',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                  
                ]
            ])
            ->add('price',MoneyType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' =>false,
                'label' => 'Prix ',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' =>[
                    new Assert\Positive(),
                    new Assert\LessThan(1001)
                ]
            ])
            ->add('isFavorite',CheckboxType::class,[
                'attr' => [
                    'class' => 'form-check-input ms-3 mt-4'
                ],
                'required' =>false,
                'label' => 'Favori ?',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' =>[
                    new Assert\NotNull()
                ]
            ])
            
            
            ->add('ingredient', EntityType::class, [

                'class'=>IngredientType::class,
                'querry_builder'=> function (IngredientRepository $r){
                    return $r->createQueryBuilder('i')
                    ->orderBy('i.name', 'ASC')
                    ->setParameter('user', $this->token->getToken()->getUser());
                },

                'label'=>'les ingrédients',
                'label_attr'=>[
                    'class' => 'form-label mt-4'
                ],
                'class' => ingredient::class,
                'query_builder'=> function (IngredientRepository $r){
                    return $r->createQueryBuilder('i')
                    ->orderBy('i.name', 'ASC');
                },


                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ])

            ->add('submit',SubmitType::class,[
                'attr' => [
                    'class' => 'btn btn-primary mt-4'
                ],
                'label' => 'créer ma recette',
             
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recettes::class,
        ]);
    }
}
