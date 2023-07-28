<?php

namespace App\Form;

use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, ["label" => "Modèle"])
            ->add('description', null, ["label" => "Déscription"])
            ->add('annee', null, ["label" => "Année"])
            ->add('kilometrage', null, ["label" => "Kilomètres"])
            ->add('chevaux', null, ["label" => "Chevaux"])
            ->add('prix')
            ->add('porte', null, ["label" => "Nombre de portes"])
            ->add('motorisation', ChoiceType::class, [
                'label' => 'Motorisation',
                'choices' => $this->getMotorisationChoices(),
            ])
            ->add('gps', ChoiceType::class, [
                'label' => 'GPS',
                'choices' => [
                    'Oui' => 0,
                    'Non' => 1,
                ],
            ])
            ->add('camera', ChoiceType::class, [
                'label' => 'Caméra',
                'choices' => [
                    'Oui' => 0,
                    'Non' => 1,
                ],
            ])
        ;
    }
private function getMotorisationChoices(): array
    {
        $choices = Voiture::MOTORISATION;
        $output = [];
        foreach ($choices as $k => $v) {
            $output[$v] = $k;
        }
        return $output;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
