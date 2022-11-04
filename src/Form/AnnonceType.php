<?php

namespace App\Form;

use App\Entity\Annonce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, array(
                'label' => 'Titre du poste :',
                'attr' => array(
                    'placeholder' => 'Titre de l\'annonce',
                ),
            ))
            ->add('lieu', TextType::class, array(
                'label' => 'Lieu :',
                'attr' => array(
                    'placeholder' => 'Lieu',
                ),
            ))
            ->add('description', TextType::class, array(
                'label' => 'Description :',
                'attr' => array(
                    'placeholder' => 'Description du poste',
                ),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}
