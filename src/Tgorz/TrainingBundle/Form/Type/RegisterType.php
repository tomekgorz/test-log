<?php

namespace Tgorz\TrainingBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Validator\Constraints as Assert;
//use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
//use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class RegisterType extends AbstractType {
    
    public function getName() {
        return 'register_form';
    }

    

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name', TextType::class, array(
                    'label' => 'Imię i Nazwisko',
                    
                ))
                ->add('email', EmailType::class, array(
                    'label' => 'Email',
                    
                ))
                ->add('sex', ChoiceType::class, array(
                    'label' => 'Płeć',
                    'choices' => array(
                        'Mężczyzna' => 'm',
                        'Kobieta' => 'f'
                    ),
                    'expanded' => true
                        )
                )
                ->add('birthdate', BirthdayType::class, array(
                    'label' => 'Data urodzenia',
                    'placeholder' => '--',
                    'empty_data' => NULL,
                    
                ))
                ->add('country', CountryType::class, array(
                    'label' => 'Kraj',
                    'placeholder' => '--',
                    'empty_data' => NULL,
                    
                ))
                ->add('course', ChoiceType::class, array(
                    'label' => 'Kurs',
                    'choices' => array(
                        'Kurs podstawowy' => 'basic',
                        'Analiza techniczna' => 'at',
                        'Analiza fundamentalna' => 'af',
                        'Kurs zaawansowany' => 'master'
                    ),
                    'placeholder' => '--',
                    'empty_data' => NULL,
                    
                ))
                ->add('invest', ChoiceType::class, array(
                    'label' => 'Inwestycje',
                    'choices' => array(
                        'Akcje' => 'a',
                        'Obligacje' => 'o',
                        'Forex' => 'f',
                        'ETF' => 'etf'
                    ),
                    'expanded' => true,
                    'multiple' => true,
                    'constraints' => array(
                        new Assert\NotBlank(),
                        new Assert\Count(array(
                            'min' => 2
                                ))
                    )
                ))
                ->add('comments', TextareaType::class, array(
                    'label' => 'Dodatkowy komentarz'
                ))
                ->add('paymentFile', FileType::class, array(
                    'label' => 'Potwierdzenie zapłaty',
                    
                ))
                ->add('rules', CheckboxType::class, array(
                    'label' => 'Akceptuje regulamin',
                    'constraints' => array(
                        new Assert\NotBlank()
                    ),
                    'mapped' => false
                ))
                ->add('save', SubmitType::class, array(
                    'label' => 'Zapisz'
        )
                );
    }
    
    public function setDefaultOptions(\Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Tgorz\TrainingBundle\Entity\Register'
        ));
    }

}
