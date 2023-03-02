<?php

namespace App\Form;

use App\Entity\CategorieServices;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class)
            ->add('description', TextareaType::class)
            ->add('enavant', CheckboxType::class, [
                'label'    => 'Catégorie mise en avant',
                'label_attr' => [
                    'class' => 'checkbox-custom-label',
                    ],
                'attr' => [
                    'class' => 'checkbox-custom',
                    'type' => 'checkbox',
                ],
                'required' => false,
            ])

            /*->add('enavant', ChoiceType::class, [
                'label' => 'Catégorie de service mise en avant : ',
                'attr' => [
                    'class' => 'form-group'
                ],
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
            ])*/
            //->add('valide')
            //->add('images')
            //->add('prestataires')
            //->add('promotion')
            ->add('Enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CategorieServices::class,
        ]);
    }
}
