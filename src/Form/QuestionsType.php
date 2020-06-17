<?php

namespace App\Form;

use App\Entity\Questions;
use App\Form\Type\SwitchType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('questions', SwitchType::class, [
                "attr" => [
                    "class" => "test"
                ],
                'choices'  => [
                    'Maybe' => null,
                    'Yes' => true,
                    'No' => false,
                ],
            ])

            ->add('theme', ChoiceType::class, [
                'choices' => [
                    'Thème 1' => 1,
                    'Thème 2' => 2,
                    'Thème 3' => 3,
                    'Thème 4' => 4,
                    'Thème 5' => 5,
                    'Thème 6' => 6,
                ],
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('likes', IntegerType::class, [
                    'required' => false,
                    'empty_data' => 0,
                    'attr' => [
                        'value' => 0,
                        'class' => 'form-control',
                    ]
            ])
            ->add('dislikes', IntegerType::class, [
                'required' => false,
                'empty_data' => 0,
                'attr' => [
                    'value' => 0,
                    'class' => 'form-control',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Questions::class,
        ]);
    }
}
