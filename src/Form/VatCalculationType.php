<?php

/**
 * VAT CALCULATOR APP.
 * (c) ktarila <ktarila@gmail.com>.
 */

namespace App\Form;

use App\Entity\VatCalculation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Range;

class VatCalculationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'monetaryValue',
                NumberType::class,
                [
                    'help' => 'Monetary Value',
                    'required' => true,
                    'html5' => true,
                    'attr' => ['step' => '0.01', 'placeholder' => '1000'],
                ]
            )
            ->add(
                'vatPercentage',
                NumberType::class,
                [
                    'help' => 'VAT Percentage between 0 and 100',
                    'required' => true,
                    'html5' => true,
                    'constraints' => [new Range(
                        [
                            'min' => 0,
                            'max' => 100,
                        ]
                    )],
                    'attr' => ['step' => '0.01', 'placeholder' => '1.15', 'min' => 0.01, 'max' => 100],
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VatCalculation::class,
        ]);
    }
}
