<?php

namespace App\Form;

use App\Entity\CategorieServices;
use App\Entity\Prestataire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
            ->add('emailcontact', EmailType::class, [
                'label' => 'Email de contact',
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom du prestataire',
            ])
            ->add('numtel', TextType::class, [
                'label' => 'Numéro de téléphone',
            ])
            ->add('numtva', TextType::class, [
                'label' => 'Numéro de TVA',
            ])
            ->add('siteinternet', TextType::class, [
                'label' => 'Site web',
            ])
            ->add('images', FileType::class, [
                'label' => 'Votre photo',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'accept' => 'image/*',
                ],
            ])
            //->add('profil')
            //->add('photo')
            ->add('proposer', EntityType::class, [
                'class' => CategorieServices::class,
                'label'    => 'Catégorie de service',
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => true])
            //->add('stages')
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
