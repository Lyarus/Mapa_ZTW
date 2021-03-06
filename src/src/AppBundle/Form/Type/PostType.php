<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert;


class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nazwaPostu', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['max' => 100]),
                ]
            ])
//            ->add('kategoriaPostu', ChoiceType::class, array(
//                'choices'=> array(
//                    'sprzedaz'=>'sprzedaz',
//                    'usterka'=>'usterka',
//                    'podroz'=>'podroz',
//                    'miejsce'=>'miejsce',
//                    'wydarzenie'=>'wydarzenie',
//                    'ciekawostki'=>'ciekawostki'
//                )
//            ))
            ->add('trescPost', TextareaType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 3, 'max' => 4000]),
                ]
            ])
//            ->add('obrazekKom', TextType::class, [
//                'constraints' => [
//                    new Assert\NotBlank(),
//                    new Assert\Length(['max' => 300]),
//                ]
//            ])
            ->add('post', SubmitType::class)
        ;
    }
}
