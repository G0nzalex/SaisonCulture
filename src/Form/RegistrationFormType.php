<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('roles', ChoiceType::class, [
                'required' => true,
                'mapped' => false,
                'multiple' => false,
                'expanded' => true,
                'choices' => [
                    'user' => 'ROLE_USER',
                    'producer' => 'ROLE_PRODUCER',
                ],
            ])
            ->add('email', EmailType::class)
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            // ->add('name', TextType::class, [
            //     'attr' => [
            //         'class' => 'producer'
            //     ],
                
            // ])
            // ->add('company', TextType::class, [
            //     'attr' => [
            //         'class' => 'producer'
            //     ],
            // ])
            // ->add('address1', TextType::class, [
            //     'attr' => [
            //         'class' => 'producer'
            //     ],
            // ])
            // ->add('address2', TextType::class, [
            //     'attr' => [
            //         'class' => 'producer'
            //     ],
            // ])
            // ->add('city', TextType::class, [
            //     'attr' => [
            //         'class' => 'producer'
            //     ],
            // ])
            // ->add('zipCode', IntegerType::class, [
            //     'attr' => [
            //         'class' => 'producer'
            //     ],
            //     'constraints' => [
            //         new Length([
            //             'min' => 5,
            //             'minMessage' => 'You have to write 5 characters for the zip code',
            //             'max' => 5,
            //             'maxMessage' => 'You have to write 5 characters for the zip code',
            //         ])
            //     ]
            // ])
            // ->add('phone', IntegerType::class, [
            //     'attr' => [
            //         'class' => 'producer'
            //     ],
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
