<?php

namespace App\Form;

use App\Entity\RegisteredUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Full Name'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Email'
                ]
            ])
            ->add('phone', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Phone Number'
                ]
            ])
            ->add('availability', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Please let us know when you are available to volunteer'
                ]
            ])
            ->add('sectors', ChoiceType::class, [
                'choices' => [
                    'Group Volunteering',
                    'Student Support',
                    'Green Initiatives',
                    'School Building Initiatives',
                    'Other'
                ],
                'choice_label' => function ($value) {
                    return $value;
                },
                'expanded' => true,
                'multiple' => true,
                'label' => 'Preferred Sector(s)',
                'label_attr' => [
                    'class' => 'field-label'
                ],
                'attr' => [
                    'class' => 'form-checkboxes'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RegisteredUser::class
        ]);
    }
}
