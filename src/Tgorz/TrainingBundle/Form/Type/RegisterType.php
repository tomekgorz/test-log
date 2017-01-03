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
//use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class RegisterType extends AbstractType {
    
    public function getName() {
        return 'register_form';
    }

    

//    public function buildForm(FormBuilderInterface $builder, array $options) {
//        $builder;
//                ->add('name', TextType::class, array(
//                    'label' => 'Imię i Nazwisko',
//                    'constraints' => array(
//                        new Assert\NotBlank(),
//                        new Assert\Regex(array(
//                            'pattern' => '/^[a-zA-Z]+ [a-zA-Z]+$/',
//                            'message' => 'Musisz podać imię i nazwisko'
//                                ))
//                    )
//                ));
//                ->add('email', EmailType::class, array(
//                    'label' => 'Email',
//                    'constraints' => array(
//                        new Assert\NotBlank(),
//                        new Assert\Email()
//                    )
//                ))
//                ->add('sex', ChoiceType::class, array(
//                    'label' => 'Płeć',
//                    'choices' => array(
//                        'Mężczyzna' => 'm',
//                        'Kobieta' => 'f'
//                    ),
//                    'expanded' => true
//                        )
//                )
//                ->add('birthdate', BirthdayType::class, array(
//                    'label' => 'Data urodzenia',
//                    'placeholder' => '--',
//                    'empty_data' => NULL,
//                    'constraints' => array(
//                        new Assert\Date()
//                    )
//                ))
//                ->add('country', CountryType::class, array(
//                    'label' => 'Kraj',
//                    'placeholder' => '--',
//                    'empty_data' => NULL,
//                    'constraints' => array(
//                        new Assert\NotBlank()
//                    )
//                ))
//                ->add('course', ChoiceType::class, array(
//                    'label' => 'Kurs',
//                    'choices' => array(
//                        'Kurs podstawowy' => 'basic',
//                        'Analiza techniczna' => 'at',
//                        'Analiza fundamentalna' => 'af',
//                        'Kurs zaawansowany' => 'master'
//                    ),
//                    'placeholder' => '--',
//                    'empty_data' => NULL,
//                    'constraints' => array(
//                        new Assert\NotBlank()
//                    )
//                ))
//                ->add('invest', ChoiceType::class, array(
//                    'label' => 'Inwestycje',
//                    'choices' => array(
//                        'Akcje' => 'a',
//                        'Obligacje' => 'o',
//                        'Forex' => 'f',
//                        'ETF' => 'etf'
//                    ),
//                    'expanded' => true,
//                    'multiple' => true,
//                    'constraints' => array(
//                        new Assert\NotBlank(),
//                        new Assert\Count(array(
//                            'min' => 2
//                                ))
//                    )
//                ))
//                ->add('comments', TextareaType::class, array(
//                    'label' => 'Dodatkowy komentarz'
//                ))
//                ->add('payment_file', FileType::class, array(
//                    'label' => 'Potwierdzenie zapłaty',
//                    'constraints' => array(
//                        new Assert\NotBlank(),
//                        new Assert\File(array(
//                            'maxSize' => '1M',
//                            'mimeTypes' => array(
//                                'application/pdf',
//                                'application/x-pdf'
//                            ),
//                            'mimeTypesMessage' => 'Potwierdzenie przelewu musi być w formie PDF'
//                                ))
//                    )
//                ))
//                ->add('rules', CheckboxType::class, array(
//                    'label' => 'Akceptuje regulamin',
//                    'constraints' => array(
//                        new Assert\NotBlank()
//                    ),
//                    'mapped' => false
//                ));
//                ->add('save', SubmitType::class, array(
//                    'label' => 'Zapisz'
//        )
//                );
//    }
    
    public function setDefaultOptions(\Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Tgorz\TrainingBundle\Entity\Register'
        ));
    }

}
