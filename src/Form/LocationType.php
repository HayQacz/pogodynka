<?php

namespace App\Form;

use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('city', TextType::class, [
                'label' => 'Miasto',
                'attr' => ['placeholder' => 'np. Szczecin'],
            ])
            ->add('country', CountryType::class, [
                'label' => 'Państwo',
                'preferred_choices' => ['PL'],
            ])
            ->add('latitude', NumberType::class, [
                'label' => 'Szerokość geograficzna',
                'scale' => 7,
                'input' => 'string',
                'html5' => true,
                'attr' => ['step' => '0.0000001'],
            ])
            ->add('longitude', NumberType::class, [
                'label' => 'Długość geograficzna',
                'scale' => 7,
                'input' => 'string',
                'html5' => true,
                'attr' => ['step' => '0.0000001'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
