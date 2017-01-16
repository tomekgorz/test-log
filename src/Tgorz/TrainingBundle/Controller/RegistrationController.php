<?php

namespace Tgorz\TrainingBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Tgorz\TrainingBundle\Entity\User;
use Tgorz\TrainingBundle\Form\Type\UserRegistrationType;

class RegistrationController extends Controller
{
    /**
     * @Route("/rejestracja", name="user_register")
     * 
     * @Template
     */
    public function registerAction(Request $Request)
    {
        $user = new User();
        
        $form = $this->createForm(UserRegistrationType::class, $user);
        
        $form->handleRequest($Request);
        
        if($form->isSubmitted() && $form->isValid()){
            $password = $this->get('security.password_encoder')
                    ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('security_login');
        }
        
        return array(
            'form' => $form->createView(),
        );
    }

}
