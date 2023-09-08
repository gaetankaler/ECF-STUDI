<?php

namespace App\Form;

use App\Entity\Commentaires;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;



class CommentairesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo', TextType::class, [
                'label' => "Votre pseudo",
                'attr' => [
                    "class" => 'form-control'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => "Votre e-mail",
                'attr' => [
                    "class" => 'form-control'
                ]
            ])
            ->add('contenue', TextareaType::class, [
                'label' => "Votre commentaire",
                'attr' => [
                    "class" => 'form-control'
                ]
            ])
            ->add('note', HiddenType::class, [
                'data' => 0,
            ])
            ->add('envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commentaires::class,
        ]);
    }
}