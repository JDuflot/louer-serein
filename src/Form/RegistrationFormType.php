<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Email',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer un email',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Votre email doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 250,
                    ]),

                ],
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ], 
                'label' => 'Nom',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer un nom',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre nom doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 250,
                    ]),
                ],
            ])
            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ], 
                'label' => 'Prénom',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer un prénom',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre prénom doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 250,
                    ]),
                ],
            ])
         
            ->add('address', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Adresse',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer une adresse',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre adresse doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 250,
                    ]),
                ],
            ])
            ->add('zip', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ], 
                'label' => 'Code postal',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer un code postal',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Votre code postal doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 5,
                    ]),
                ],
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ], 
                'label' => 'Ville',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer une ville',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre ville doit contenir au moins {{ limit }} caractères',
                        'max' => 4096,
                    ]),
                ],
            ])
            
            ->add('RGPDConsent', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms',
                    ]),
                ],
                'label' => 'En m\'inscrivant sur ce site , j\'accepte .... ',
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'class' => 'form-control',
                ],
                'label' => 'Mot de passe',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
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
