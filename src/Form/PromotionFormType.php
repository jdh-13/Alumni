<?php

namespace App\Form;

use App\Entity\Degree;
use App\Entity\Promotion;
use App\Entity\Year;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class PromotionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        //requirer false
        $builder ->add('degree',EntityType::class,
                        [
                        'label' => 'Formation Associées',
                        'class'=>Degree::class,
                        'choice_label' => 'name'
                        ])

                ->add('year',EntityType::class,
                    [
                     'label' => 'Annes associés',
                    'class' => Year::class,
                    'choice_label' =>'title'
                    ])

                ->add('startDate',DateType::class,
                    [
                        'label' => 'Années de debut',
                        'required' =>false // pour mettre le champs vide
                    ])
                ->add('endDate',DateType::class,
                [
                    'label' => 'Années de fin'

                ])

                ->add('notes',TextareaType::class,
                [
                    'label' => 'notes'
                ]);



    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Promotion::class,
        ]);
    }
}