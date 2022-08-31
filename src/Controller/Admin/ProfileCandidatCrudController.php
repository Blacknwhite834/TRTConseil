<?php

namespace App\Controller\Admin;

use App\Entity\Candidature;
use App\Entity\ProfileCandidat;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use Symfony\Component\DomCrawler\Field\FileFormField;
use Symfony\Component\DomCrawler\Image;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
                ->hideOnIndex()
                ->setUploadDir('public/uploads/images/'),
            TextField::new('cv')->setTemplatePath('admin/document_link.html.twig')->onlyOnIndex(),


        ];
    }

}
