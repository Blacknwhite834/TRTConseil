<?php

namespace App\Form;

use App\Entity\ProfileRecruteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class CompleteRecruteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom', null, array(

                'label' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer le nom de l\'entreprise',
                    ]),
                ],
            ))
            ->add('Adresse', null, array(

                'label' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer l\'adresse de l\'entreprise',
                    ]),
                ],
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProfileRecruteur::class,
        ]);
    }
}
