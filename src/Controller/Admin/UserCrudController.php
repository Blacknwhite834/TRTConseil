<?php

namespace App\Controller\Admin;
use App\Entity\ProfileCandidat;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Configurator\BooleanConfigurator;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

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
                ->onlyOnIndex(),
            TextField::new('Email'),
            BooleanField::new('is_verified')
                ->setLabel('Verifié(email)'),
            ArrayField::new('roles'),
            BooleanField::new('is_approved')
                ->setLabel('Approuvée par le consultant'),
        ];
    }

}
