<?php

namespace App\Form;

use App\Entity\CategorieServices;
use App\Entity\Prestataire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormTypeInterface;


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
            ->add('proposer', EntityType::class, [
                'class' => CategorieServices::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true])
            //->add('organiser')
            //->add('offrir')
            //->add('favori')
            //->add('concerner')
            ->add('Enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Prestataire::class,
        ]);
    }
}
