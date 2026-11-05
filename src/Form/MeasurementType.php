<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\Measurement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeasurementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'choice_label' => fn (Location $l) => $l->getCity() . ', ' . $l->getCountry(),
                'label' => 'Lokalizacja',
            ])
            ->add('measuredAt', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Data pomiaru',
            ])
            ->add('temperatureC', NumberType::class, [
                'input' => 'string',
                'scale' => 2,
                'html5' => true,
                'attr' => ['step' => '0.01'],
                'label' => 'Temperatura (°C)',
            ])
            ->add('humidity', IntegerType::class, [
                'label' => 'Wilgotność (%)',
            ])
            ->add('pressure', IntegerType::class, [
                'label' => 'Ciśnienie (hPa)',
            ])
            ->add('windSpeed', NumberType::class, [
                'input' => 'string',
                'scale' => 2,
                'html5' => true,
                'attr' => ['step' => '0.01'],
                'label' => 'Prędkość wiatru (m/s)',
            ])
            ->add('precipitation', NumberType::class, [
                'input' => 'string',
                'scale' => 2,
                'html5' => true,
                'attr' => ['step' => '0.01'],
                'label' => 'Opady (mm)',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Measurement::class,
        ]);
    }
}
