<?php

namespace App\Form;

use App\Entity\RechercheVoiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheVoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prixMax', IntegerType::class, [
              "required" => false,
              "label" => false,
              "attr" =>  [
                "placeholder" => "Prix max"
              ]
            ])
            ->add('anneeMax', IntegerType::class, [
              "required" => false,
              "label" => false,
              "attr" =>  [
                "placeholder" => "Année max"
              ]
            ])
            ->add('kilometreMax', IntegerType::class, [
              "required" => false,
              "label" => false,
              "attr" =>  [
                "placeholder" => "Kilomètre max"
              ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RechercheVoiture::class,
            "method" => "get",
            "csrf_protection" => false,
        ]);
    }
    public function getBlockPrefix(): string
    {
        return '';
    }
}
