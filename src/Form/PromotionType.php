<?php

namespace App\Form;

use App\Entity\Promotion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromotionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de la promotion',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description de la promotion',
            ])
            ->add('affichagede', DateType::class, [
                'label' => 'Affichage du',
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy',
                'attr' => ['class' => 'datepicker',
                    'placeholder' => 'jj/mm/aaaa'],
            ])
            ->add('affichagejusque', DateType::class, [
                'label' => 'Affichage jusqu\'au',
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy',
                'attr' => ['class' => 'datepicker',
                    'placeholder' => 'jj/mm/aaaa'],
            ])
            ->add('debut', DateType::class, [
                'label' => 'Début de la promotion',
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy',
                'attr' => ['class' => 'datepicker',
                    'placeholder' => 'jj/mm/aaaa'],
            ])
            ->add('fin', DateType::class, [
                'label' => 'Fin de la promotion',
                'widget' => 'single_text',
                'html5' => false,
                'format' => 'dd/MM/yyyy',
                'attr' => ['class' => 'datepicker',
                    'placeholder' => 'jj/mm/aaaa'],
            ])

            /*->add('documentpdf', FileType::class, [
                'label' => 'Document PDF',
                'mapped' => false,
                'required' => false,
            ])
            ->add('prestataire', EntityType::class, [
                'class' => 'App\Entity\Prestataire',
                'choice_label' => 'nom',
                'label' => 'Prestataire',
            ])*/
            ->add('Enregistrer', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Promotion::class,
        ]);
    }
}
