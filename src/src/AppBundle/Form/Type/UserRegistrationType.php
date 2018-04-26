<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Entity\Uzytkownik;

class UserRegistrationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
//            ->add('imie', TextType::class, [
//                'constraints' => [
//                    new Assert\NotBlank(),
//                    new Assert\Length(['max' => 20]),
//                ]
//            ])
//            ->add('nazwisko', TextType::class, [
//                'constraints' => [
//                    new Assert\NotBlank(),
//                    new Assert\Length(['max' => 20]),
//                ]
//            ])
//            ->add('dataUr', TextType::class, array(
//                'widget' => 'single_text',
//
//                // prevents rendering it as type="date", to avoid HTML5 date pickers
//                'html5' => false,
//
//                // adds a class that can be selected in JavaScript
//                'attr' => ['class' => 'js-datepicker'],
//            ))
//
//            ->add('obrazekU', TextType::class, [
//                'constraints' => [
//                    new Assert\NotBlank(),
//                    new Assert\Length(['max' => 300]),
//                ]
//            ])
//
//            ->add('miastoU', TextType::class, [
//                'constraints' => [
//                    new Assert\NotBlank(),
//                    new Assert\Length(['max' => 100]),
//                ]
//            ])
//
            ->add('login', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['max' => 100]),
                ]
            ])

            ->add('email', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['max' => 100]),
                ]
            ])

            ->add('haslo', PasswordType::class, [
                'mapped' => false,
                'constraints' => [
                    new Assert\NotBlank(),
                ]
            ])

//            ->add('email', TextType::class, [
//                'constraints' => [
//                    new Assert\NotBlank(),
//                    new Assert\Length(['max' => 100]),
//                ]
//            ])

            ->add('register', SubmitType::class)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Uzytkownik::class,
        ]);
    }
}
