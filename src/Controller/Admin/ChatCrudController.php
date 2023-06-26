<?php

namespace App\Controller\Admin;

use App\Entity\Chat;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ChatCrudController extends AbstractCrudController
{
    public function configureActions(Actions $actions): Actions
    {
        $actions->disable(Action::EDIT);
        return $actions;
    }

    public static function getEntityFqcn(): string
    {
        return Chat::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                    ->hideOnForm(),
            IdField::new('user_id')
                    ->hideOnForm(),
        TextField::new('sender'),
        TextField::new('recipient'),
        TextEditorField::new('message'),
       
        DateTimeField::new('createdAt')
            ->setFormTypeOption('disabled', 'disabled'),
        ];
    }
    
}
