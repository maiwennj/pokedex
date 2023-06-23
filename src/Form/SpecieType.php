<?php

namespace App\Form;

use App\Entity\Specie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SpecieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void{
        $builder
            ->add('number',null,['label'=>'Number : ','attr'=>['min'=>1]])
            ->add('name',null,['label'=>'Name : '])
            ->add('types',null,['label'=>'Types : ','multiple'=>true])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Specie::class,
        ]);
    }
}
