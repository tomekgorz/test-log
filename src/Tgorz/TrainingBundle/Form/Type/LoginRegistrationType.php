<?php

namespace Tgorz\TrainingBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

//use Tgorz\TrainingBundle\Entity\User;

class LoginRegistrationType extends AbstractType {
    
    public function getName(){
        return 'login';
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('username', TextType::class, array(
            'label' => 'Login'
        ))
            ->add('password', PasswordType::class, array(
                'label' => 'Password'
            ))
            ->add('login', SubmitType::class, array(
                'label' => 'Log-in'
            ));
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => null,
        ));
    }
    
}
