<?php

namespace App\Form;

use App\Entity\Prestataire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrestataireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('emailcontact')
            ->add('nom')
            ->add('numtel')
            ->add('numtva')
            ->add('siteinternet')
            ->add('images')
            ->add('profil')
            ->add('photo')
            ->add('proposer')
            ->add('organiser')
            ->add('offrir')
            ->add('favori')
            ->add('concerner')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prestataire::class,
        ]);
    }
}
