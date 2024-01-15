<?php

namespace App\Form;

use App\Entity\TipoSoporte;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SoporteForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('descripcion', TextType::class, [
                'label' => 'Descripción',
                'attr' => [
                    'placeholder' => 'Agregar descripción',
                    'class' => 'form-control',
                    'required' => true,
                ]
            ])
            ->add('complejidad', ChoiceType::class,[
                'choices' => [
                    '10' => 10,
                    '20' => 20,
                    '30' => 30,
                ],
                'label' => 'Nivel de Complejidad',
                'attr' => [
                    'placeholder' => 'Agregar nivel de complejidad',
                    'class' => 'form-control',
                    'required' => true,
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Guardar',
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TipoSoporte::class,
        ]);
    }
}
