<?php

namespace App\Form;

use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Locationname',
                'required' => true,
                'attr' => [
                    'style' =>'background-color: white;',
                    'placeholder' => 'Bitte trage die Location ein!'
                ]
            ])
            ->add('capacity', IntegerType::class,[
                'label' => 'Kapazität',
                'required' => true,
                'attr' => [
                    'style' =>'background-color: white;',
                    'placeholder' => 'Bitte trage die Kapazität der Location ein!'
                ]
            ])
            ->add('address', TextType::class, [
                'label' => 'Adresse',
                'required' => true,
                'attr' => [
                    'style' =>'background-color: white;',
                    'placeholder' => 'Bitte trage die Adresse ein!'
                ]
            ])
            ->add('save', SubmitType::class)
            ->add('reset', ResetType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
