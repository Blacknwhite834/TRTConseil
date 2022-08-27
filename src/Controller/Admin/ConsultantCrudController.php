<?php

namespace App\Controller\Admin;

use App\Entity\Consultant;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ConsultantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Consultant::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->onlyOnIndex(),
            TextField::new('email'),
            TextField::new('password'),
            ArrayField::new('roles'),
            BooleanField::new('is_verified')
                ->setLabel('Verifié(email)'),
        ];
    }

}
