<?php

namespace App\Form;

use App\Entity\Degree;
use App\Entity\Promotion;
use App\Entity\Year;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use function Sodium\add;

class PromotionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
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

                ->add('startDate',TextType::class,
                    [
                        'label' => 'Années de debut',
                        'choice_label' =>'star_date'
                    ])
                ->add('endDate',TextType::class,
                [
                    'label' => 'Années de fin ',
                    'choice_label' =>'end_date'
                ])

                ->add('notes',TextType::class,
                [
                    'label' => 'notes',
                    'choice_label' =>'notes'
                ]);



    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Promotion::class,
        ]);
    }
}