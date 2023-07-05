<?php

namespace App\Form;

use App\Entity\Rental;
use App\Entity\Equipment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RentalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr' => [
                    'class' => 'form-control mt-3',
                    'placeholder' => "Titre de la location",
                ],
                'label_attr' => [],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer un titre',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre titre doit contenir au moins {{ limit }} caractères',
                        'max' => 250,
                    ]),
                ],
            ])

            ->add('imageFile', VichImageType::class, [
                'attr' => [
                    'class' => 'form-control mt-3',
                    'placeholder' => "Image de couverture de la location",
                ],
                'label' => 'Photo de couverture',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'insérer une photo de couverture',
                    ]),
                ],
                'download_uri' => true,
                'image_uri' => true,
                'allow_delete' => true,
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control mt-3',
                    'placeholder' => "Description de la location",
                ],
                'label' => 'Description',
                'label_attr' => [],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer une description',
                    ]),
                    new Length([
                        'min' => 30,
                        'minMessage' => 'Votre description doit contenir au moins {{ limit }} caractères',
                        'max' => 450,
                    ]),
                ],
            ])
            ->add('price', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control mt-3',
                    'placeholder' => "Prix de la location",
                ],
                'label' => 'Prix',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer un prix',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre prix doit contenir au moins {{ limit }} caractères',
                        'max' => 8,
                    ]),
                ],
            ])
            ->add('location', TextType::class, [
                'attr' => [
                    'class' => 'form-control mt-3',
                    'placeholder' => "Localisation de la location",
                ],
                'label' => 'Localisation',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer la localisation',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre localisation doit contenir au moins {{ limit }} caractères',
                        'max' => 250,
                    ]),
                ],
            ])
            ->add('equipments', EntityType::class, [
                'multiple'=>true,
                'expanded' => true,
                'label' => 'Équipement(s)',
                'class'=> Equipment::class,
                'attr' => [
                    'class' => 'form-control mt-3',
                ],
             ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rental::class,
        ]);
    }
    
}
