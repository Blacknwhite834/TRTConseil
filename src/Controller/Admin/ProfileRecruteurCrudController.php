<?php

namespace App\Controller\Admin;

use App\Entity\ProfileRecruteur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProfileRecruteurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProfileRecruteur::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->onlyOnIndex(),
            TextField::new('nom'),
            TextField::new('adresse'),
            TextField::new('email_adress'),
        ];
    }

}
