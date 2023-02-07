<?php

namespace App\Form;

use App\Entity\Internaute;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InternauteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('newsletter', CheckboxType::class, [
                'label' => "Je souhaite recevoir la Newsletter",
                'mapped' => false,
                'required' => false
            ])
            ->add('nom')
            ->add('prenom')
            ->add('images')
            ->add('blocs')
            ->add('prestataires')
            ->add('commentaire')
            ->add('abus')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Internaute::class,
        ]);
    }
}
