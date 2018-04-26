<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Kategoria_miejsca;
use AppBundle\Entity\Miejsce;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;


class MiejsceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nazwaM', TextType::class, array('label' => 'Nazwa miejsca:'), [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['max' => 30]),
                ]
            ])
            ->add('adresM', TextType::class, array('label' => 'Adres miejsca:'), [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['max' => 100]),
                ]
            ])
            ->add('lat', TextType::class, array(
                'label' => 'Szerokość geograficzna:',
                'attr'=> array('readonly'=>true)
            ), [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['max' => 100]),
                ]
            ])
            ->add('lng', TextType::class, array(
                'label' => 'Długość geograficzna:',
                'attr'=> array('readonly'=>true)
                ), [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['max' => 100]),
                ]
            ])
//            ->add('idKategoria', EntityType::class, [
//                'label' => 'Kategoria miejsca:',
//                'placeholder' => 'Wybierz kategorię miejsca',
//                'class' => 'AppBundle:Kategoria_miejsca',
//                'choice_label' => 'nazwaK',
//                'choice_value' => function (Kategoria_miejsca $kategoria_miejsca = null) {
//                    if ($kategoria_miejsca) {
//                        return $kategoria_miejsca->getIdKategorii();
//                    } else {
//                        return '';
//                    }
//                },
//            ])
            ->add('opisM', TextareaType::class, array('label' => 'Opis miejsca:'), [
                'constraints' => [

                    new Assert\Length(['min' => 3, 'max' => 4000]),
                ]
            ])
            ->add('linkM', TextType::class, array('label' => 'Link do miejsca:'), [
                'constraints' => [

                    new Assert\Length(['max' => 200]),

                ]
            ])
            ->add('telefonM', IntegerType::class, array('label' => 'Telefon kontaktowy:'), [
                'constraints' => [

                ]
            ])
            ->add('obrazekM', FileType::class, array('label' => 'Obrazek (JPEG, PNG):', 'attr'=>array('oninvalid'=>"setCustomValidity()") ),[
                'constraints' => [

                ]
            ])
            ->add('akceptuj', SubmitType::class, array('label' => 'Akceptuj'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Miejsce::class,
        ));
    }

}
