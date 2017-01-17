<?php
namespace Tgorz\TrainingBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Validator\Constraints\IsTrue;

use Tgorz\TrainingBundle\Entity\User;

class UserRegistrationType extends AbstractType{
    
    public function getName(){
        return 'user';
    }


    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('username', TextType::class, array(
            'label' => 'Login',
        ))
            ->add('email', EmailType::class, array(
                'label' => 'Email'
            ) )
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat password'),
                
            ))
            ->add('termsAccepted', CheckboxType::class, array(
                'mapped' => false,
                'constraints' => new IsTrue()
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'Registration'
            ));
    }
    
//    public function configureOptions(OptionsResolver $resolver) {
//        $resolver->setDefault(array(
//           'data_class' => User::class,
//        ));
//    }
    
}
