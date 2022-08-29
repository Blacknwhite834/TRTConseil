<?php

namespace App\Controller\Admin;

use App\Entity\ProfileCandidat;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use Symfony\Component\DomCrawler\Field\FileFormField;
use Symfony\Component\DomCrawler\Image;

class ProfileCandidatCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProfileCandidat::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')
                ->onlyOnIndex(),
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('email_adress'),
            ImageField::new('cv')
                ->setBasePath('uploads/images/')
                ->setUploadDir('public/uploads/images/'),

        ];
    }

}
