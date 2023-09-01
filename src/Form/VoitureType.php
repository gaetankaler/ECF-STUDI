<?php

namespace App\Form;

use App\Entity\Voiture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Vich\UploaderBundle\Form\Type\VichImageType;




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
            ->add("imageFile", FileType::class, [
                "label" => "Photo de couverture",
                "required" => false
            ])
            ->add('imageCarousel1', FileType::class, [
                'label' => 'Image Carousel 1',
                'required' => false
            ])
            ->add('imageCarousel2', FileType::class, [
                'label' => 'Image Carousel 2',
                'required' => false

            ])
            ->add('imageCarousel3', FileType::class, [
                'label' => 'Image Carousel 3',
                'required' => false
            ])
            ->add('porte', ChoiceType::class, [
                'label' => 'Nombre de portes',
                'choices' => [
                    "3" => "3",
                    "5" => "5",
                ],
            ])
            ->add('motorisation', ChoiceType::class, [
                'label' => 'Motorisation',
                'choices' => array_flip($this->getMotorisationChoices()),
            ])
            ->add('gps', ChoiceType::class, [
                'label' => 'GPS',
                'choices' => [
                    'Oui' => "Oui",
                    'Non' => "Non",
                ],
            ])
            ->add('camera', ChoiceType::class, [
                'label' => 'Caméra',
                'choices' => [
                    'Oui' => "Oui",
                    'Non' => "Non",
                ],
            ]);
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