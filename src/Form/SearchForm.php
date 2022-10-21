<?php

namespace App\Form;

use App\Entity\SearchData;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SearchForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('specie', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'specie'
                ]
            ])
            ->add('size', NumberType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'size'
                ]
            ])
            ->add('color', ChoiceType::class, [
                'choices' => [
                    'blue' =>'blue',
                    'green' =>'green',
                    'yellow' =>'yellow',
                    'red' =>'red',
                    'pink' =>'pink',
                    'gray' =>'gray',
                    'black' =>'black',
                    'white' =>'white',
                ],
                'label' => false,
                'required' => false,
                'multiple'=>true,
                'attr' => [
                    'placeholder' => 'color'
                ]
            ])
            ->add('Filtrer', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }

}