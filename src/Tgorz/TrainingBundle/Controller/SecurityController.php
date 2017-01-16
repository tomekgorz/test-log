<?php

namespace Tgorz\TrainingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Tgorz\TrainingBundle\Form\Type\LoginRegistrationType;
use Tgorz\TrainingBundle\Entity\User;

/**
     * @Route("/blog")
     * 
     * 
     */
class SecurityController extends Controller
{
    /**
     * @Route("/login", name="security_login")
     * 
     * @Template()
     */
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        
        $lastUsername = $authenticationUtils->getLastUsername();
        $user = new User();
        $loginForm = $this->createForm(LoginRegistrationType::class, array(
            'username' => $lastUsername
        ));
        return array(
            'loginForm' => $loginForm->createView(),
            'error' => $error
        );
    }

}
