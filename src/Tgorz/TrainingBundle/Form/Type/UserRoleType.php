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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\IsTrue;

use Tgorz\TrainingBundle\Entity\User;

class UserRoleType extends AbstractType {

    public function getName() {
        return 'user_role';
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('role', ChoiceType::class, array(
                    'label' => 'Role',
                    'choices' => array(
                        'ROLE_USER' => 'ROLE_USER',
                        'ROLE_MODERATOR' => 'ROLE_MODERATOR',
                        'ROLE_ADMIN' => 'ROLE_ADMIN',
                        
                    ),
                    'placeholder' => '--',
                    'empty_data' => NULL,
                ))
                ->add('save', SubmitType::class, array(
                    'label' => 'Save'
        ));
    }

//    public function configureOptions(OptionsResolver $resolver) {
//        $resolver->setDefault(array(
//           'data_class' => User::class
//        ));
//    }
}
