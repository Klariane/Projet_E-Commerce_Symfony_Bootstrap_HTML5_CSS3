<?php

namespace App\Form;

use App\Entity\Adress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label'=>'Quel nom souhaitez vous donner à votre adresse? ',
                'attr'=>[
                    'placeholder'=>'Nommez votre adresse'
                ]
            ])

            ->add('firstname', TextType::class, [
                'label'=>'Votre prénom ',
                'attr'=>[
                    'placeholder'=>'Entrez votre prénom s\'il vous plaît.'
                ]
            ])

            ->add('lastname', TextType::class, [
                'label'=>'Votre nom ',
                'attr'=>[
                    'placeholder'=>'Entrez votre nom s\'il vous plaît.'
                ]
            ])

            ->add('company', TextType::class, [
                'label'=>'Votre société ',
                'required'=>false,
                'attr'=>[
                    'placeholder'=>'Entrez votre société s\'il vous plaît(facultatif).'
                ]
            ])

            ->add('adress', TextType::class, [
                'label'=>'Adresse ',
                'attr'=>[
                    'placeholder'=>'8 Avenue jean-jaurès ...'
                ]
            ])

            ->add('postal', TextType::class, [
                'label'=>'Votre Code Postal ',
                'attr'=>[
                    'placeholder'=>'Entrez votre code postal s\'il vous plaît.'
                ]
            ])

            ->add('city', TextType::class, [
                'label'=>'Votre Ville ',
                'attr'=>[
                    'placeholder'=>'Entrez votre ville s\'il vous plaît.'
                ]
            ])

            ->add('country', CountryType::class, [
                'label'=>'Votre pays  ',
                'attr'=>[
                    'placeholder'=>'Entrez votre adresse s\'il vous plaît.'
                ]
            ])

            ->add('phone', TelType::class, [
                'label'=>'Votre numéro de téléphone ',
                'attr'=>[
                    'placeholder'=>'Entrez votre numéro de téléphone s\'il vous plaît.'
                ]
            ])

            ->add('submit', SubmitType::class, [
                'label'=>'Valider',
                'attr'=>[
                    'class'=>'btn-block btn-info'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adress::class,
        ]);
    }
}
