<?php

namespace App\Form;

use App\Entity\User;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;


class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
                'attr' => [
                    'class' => 'form-control',
                   'minlength' => '2',
                   'maxlength' => '180',                  
                ],
                'label' => 'Adress email',
                'label_attr'=>[
                    'class' => 'form-label'
                ],
                'constraints' =>[
                    new Assert\NotBlank(),
                    new Assert\Email(),
                    new Assert\Length(['min'=>2,'max'=>180]),
                
                ]
            ])
            ->add('plainPassword', RepeatedType::class,[
                'type'=> PasswordType::class,
                'first_options'=>[
                    'attr' => [
                        'class' => 'form-control'
                    ],
                    'label' => 'Mot de Passe',
                    'label_attr'=>[
                        'class' => 'form-label'
                    ],
                ],

                    'second_options'=>[
                        'attr' => [
                            'class' => 'form-control'],
                        'label'=>'Confirmation du Mot de Passe',
                        'label_attr'=>[
                        'class' => 'form-label'
                    ],
                    ],
                    'invalid_message'=>"les mots de passe ne correspondent pas"


                ])

            

            



            ->add('name', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => 2,
                    'maxlength' => 50,                  
                ],
                'label' => 'Nom',
                'label_attr'=>[
                    'class' => 'form-label'
                ],
                'constraints' =>[
                    new Assert\NotBlank(),
                    new Assert\Length(['min'=>2,'max'=>50]),
                
                ]
            ])
            ->add('pseudo',TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => 2,
                    'maxlength' => 50,                  
                ],
                'label' => 'Pseudo',
                'label_attr'=>[
                    'class' => 'form-label'
                ],
                'constraints' =>[
                
                    new Assert\Length(['min'=>2,'max'=>50])]])

            ->add('submit', SubmitType::class,[
                'attr'=>[
                    'class'=>'btn btn-primary mt-4'
                ],
                'label' => 'enregistrer',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
