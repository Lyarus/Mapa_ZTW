<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert;


class KomentarzType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('trescKom', TextareaType::class, [
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
            ->add('komentarz', SubmitType::class)
        ;
    }
}
