<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\EventTypeEnum;
use App\Entity\Location;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'empty_data' => '',
                'label' => 'Eventname',
                'required' => false,
//                'help' => 'Bitte trage den Eventnamen ein!',
                'attr' => [
                    'class' => 'bar',
                    'style' => 'background-color: white',
                    'placeholder' => 'Bitte trage den Eventnamen ein!'
                ],
            ])
            ->add('description', TextType::class, [
                'label' => 'Eventbeschreibung',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Bitte trage die Eventbeschreibung ein!'
                ]
            ])
            ->add('bookedSeats', IntegerType::class, [
                'label' => 'Gebuchte Tickets',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Bitte gebe die Anzahl gebuchter Tickets ein!',
                    'min' => 0
                ]
            ])
            ->add('eventType', EnumType::class, ['class' => EventTypeEnum::class ,
                'expanded' => true,
                'multiple' => false,
                'label' => 'Eventtyp',
                ])
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'choice_label' => 'name',
                'placeholder' => 'Bitte gebe eine Location an!',
                'required' => false,
//                'label' => 'Extra',
//                'expanded' => true,
            ])

            ->add('save', SubmitType::class)
            ->add('reset', ResetType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
