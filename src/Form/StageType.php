<?php

namespace App\Form;

use App\Entity\Prestataire;
use App\Entity\Stage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom du stage',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description du stage',
            ])
            ->add('affichagede', DateType::class, [
                'label' => 'Affichage du',
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy',
                'attr' => ['class' => 'datepicker'],
            ])
            ->add('affichagejusque', DateType::class, [
                'label' => 'Affichage jusqu\'au',
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy',
                'attr' => ['class' => 'datepicker'],
            ])
            ->add('debut', DateType::class, [
                'label' => 'Début du stage',
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy',
                'attr' => ['class' => 'datepicker'],
            ])
            ->add('fin', DateType::class, [
                'label' => 'Fin du stage',
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy',
                'attr' => ['class' => 'datepicker'],
            ])
            ->add('infocomplementaire', TextareaType::class, [
                'label' => 'Informations complémentaires',
            ])
            ->add('tarif', TextType::class, [
                'label' => 'Tarif',
            ])
            ->add('prestataire', EntityType::class, [
                'class' => Prestataire::class,
                'label' => 'Prestataire',
                'choice_label' => 'nom',
            ])
            ->add('Enregistrer', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stage::class,
        ]);
    }
}
