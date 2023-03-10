<?php

namespace App\Form;

use App\Entity\Personaje;
use App\Entity\Planetas;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonajeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('power')
            // ->add('photo', FileType::class, ['required'=>false, 'mapped'=>false])
            ->add('image')
            ->add('race')
            ->add('planetas',EntityType::class, [
                'class'=> Planetas::class,
                'choice_label'=> 'name',
                'multiple'=> true,
                'expanded'=>true
                ])
            ->add('Guardar',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personaje::class,
        ]);
    }
}
