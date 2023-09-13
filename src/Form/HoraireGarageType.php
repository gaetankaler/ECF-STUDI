<?php

namespace App\Form;

use App\Entity\HoraireGarage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class HoraireGarageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('jour', TextType::class, [
                'label' => 'Jour de la semaine',
            ])
            ->add('ouvertureMatin', TextType::class, [
                'label' => 'Heure d\'ouverture le matin',
                'required' => false,
            ])
            ->add('fermetureMatin', TextType::class, [
                'label' => 'Heure de fermeture le matin',
                'required' => false,
            ])
            ->add('ouvertureApresMidi', TextType::class, [
                'label' => 'Heure d\'ouverture l\'après-midi',
                'required' => false,
            ])
            ->add('fermetureApresMidi', TextType::class, [
                'label' => 'Heure de fermeture l\'après-midi',
                'required' => false,
            ])
            ->add('fermer', CheckboxType::class, [
                'label' => 'Fermé',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HoraireGarage::class, 
        ]);
    }
}
