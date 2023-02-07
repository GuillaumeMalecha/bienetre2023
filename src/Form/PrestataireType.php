<?php

namespace App\Form;

use App\Entity\Prestataire;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrestataireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('emailcontact', EmailType::class)
            ->add('nom', TextType::class)
            ->add('numtel', TextType::class)
            ->add('numtva', TextType::class)
            ->add('siteinternet', TextType::class)
            //->add('images')
            //->add('profil')
            //->add('photo')
            //->add('proposer')
            //->add('organiser')
            //->add('offrir')
            //->add('favori')
            //->add('concerner')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prestataire::class,
        ]);
    }
}
