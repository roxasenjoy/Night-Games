<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SwitchType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getParent()
    {
        return ChoiceType::class;
    }

    public function getName(){
        return "switch";
    }
}