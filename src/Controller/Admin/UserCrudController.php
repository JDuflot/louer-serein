<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->hideOnForm(),
            EmailField::new('email'),
            TextField::new('password'),
            ArrayField::new('roles'),
            TextField::new('firstname'),
            TextField::new('lastname'),
            ImageField::new('picture')->setUploadDir('public/img/')->setRequired(false),
            TextField::new('address'),
            TextField::new('zip'),
            TextField::new('city'),
            IntegerField::new('rating')
                ->hideOnForm(),
            DateTimeField::new('createdAt')
                ->setFormTypeOption('disabled', 'disabled'),
            CollectionField::new('rentals'),
            // CollectionField::new('chat'),
        ];
    }
}
