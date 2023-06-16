<?php

namespace App\Form;

use App\Entity\Pokemon;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PokemonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',
                null,[
                    'label'=>"Name : ",
                'required'=>true,
                'attr'=>['placeholder'=>'Your pokemon\'s name'],
            ] )
            ->add('catchDate', null,['label'=>"Caught on : "])
            ->add('catchPlace', null,['label'=>"Caught in : "])
            ->add('level', null,['label'=>"Level : "])
            ->add('hp', null,['label'=>"HP : "])
            ->add('isShiny', null,['label'=>"Is it shiny ?"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pokemon::class,
        ]);
    }
}
