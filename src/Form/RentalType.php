<?php

namespace App\Form;

use App\Entity\Rental;
use PhpParser\Parser\Multiple;
use App\Entity\RentalEquipment;
use App\Form\RentalEquipmentType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RentalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => "Titre de la location",
                ],
                'label' => 'Titre',
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
            ->add('cover', FileType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => "Image de couverture de la location",
                ],
                'label' => 'Photo de couverture',
                'label_attr' => [],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'insérer une photo de couverture',
                    ]),
                ],
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
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
                    'class' => 'form-control',
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
                    'class' => 'form-control',
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
            ->add('rentalEquipment', RentalEquipmentType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rental::class,
        ]);
    }
}
