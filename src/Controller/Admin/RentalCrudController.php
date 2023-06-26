<?php

namespace App\Controller\Admin;

use App\Entity\Rental;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RentalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Rental::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            TextField::new('title'),
            TextEditorField::new('description'),
            IntegerField::new('price'),
            TextField::new('location'),
            DateTimeField::new('updatedAt')
                ->setFormTypeOption('disabled', 'disabled'),
            // AssociationField::new('rentalEquipment')
            // ->onlyOnIndex(),
            // ArrayField::new('rentalEquipment')
            // ->onlyOnDetail(),
        ];
    }
}
