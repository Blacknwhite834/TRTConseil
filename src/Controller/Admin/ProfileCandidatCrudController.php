<?php

namespace App\Controller\Admin;

use App\Entity\ProfileCandidat;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProfileCandidatCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProfileCandidat::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
