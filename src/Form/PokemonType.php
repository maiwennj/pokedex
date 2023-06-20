<?php

namespace App\Form;

use App\Entity\Pokemon;
use App\Entity\Specie;
use App\Entity\Type;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('specie',EntityType::class,['label'=>'Specie : ','class'=>Specie::class,'choice_label'=>'name'])
            ->add('catchPlace', ChoiceType::class,['label'=>"Caught in : ",
                                    'choices'=>['Kanto'=>'Kanto',
                                        'Johto'=>'Johto',
                                        'Hoenn'=>'Hoenn',
                                        'Sinnoh'=>'Sinnoh',
                                        'Unys'=>'Unys',
                                        'Kalos'=>'Kalos',
                                        'Alola'=>'Alola',
                                        'Galar'=>'Galar',
                                        'Hisui'=>'Hisui',
                                        'Paldea'=>'Paldea'],
                ])
            ->add('level', null,['label'=>"Level : ",'attr'=>['min'=>1] ])
            ->add('hp', null,['label'=>"HP : ",'attr'=>['min'=>0]])
            ->add('isShiny', null,['label'=>"Shiny ?"]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pokemon::class,
        ]);
    }
}
