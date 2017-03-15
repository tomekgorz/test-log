<?php

namespace Tgorz\TrainingBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Tgorz\TrainingBundle\Entity\User;
use Tgorz\TrainingBundle\Form\Type\UserRegistrationType;
use Tgorz\TrainingBundle\Form\Type\UserRoleType;

class RegistrationController extends Controller {

    /**
     * @Route("/blog/rejestracja", name="user_register")
     * 
     * @Template
     */
    public function registerAction(Request $Request) {
        $user = new User();

        $form = $this->createForm(UserRegistrationType::class, $user);

        $form->handleRequest($Request);

        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->get('security.password_encoder')
                    ->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $smgBody = $this->render('TgorzTrainingBundle:Email:role.html.twig', array('username' => $user->getUsername(), 'url' => 'tgorz_add_role', 'id' => $user->getId()));
            $message = \Swift_Message::newInstance()
                    ->setSubject("Moderacja Użytkownika")
                    ->setFrom(array($user->getEmail() => $user->getUsername()))
                    ->setTo(array('tgorz89@gmail.com' => 'Tomasz Górz'))
                    ->setBody($smgBody, 'text/html');
            $this->get('mailer')->send($message);




            return $this->redirectToRoute('security_login');
        }

        return array(
            'form' => $form->createView(),
        );
    }

    /**
     * 
     * @param type $id
     * 
     * @Route("admin/users/role/{id}", name="tgorz_add_role")
     * 
     * 
     */
    public function addRoleAction(Request $Request, $id) {

        $Repo = $this->getDoctrine()->getRepository('TgorzTrainingBundle:Role');

        $UserRole = $Repo->find($id);
//        var_dump($User);
        if ($UserRole == NULL) {
            $message = 'Nie znaleziono takiego użytkownik';
            throw $this->createNotFoundException($message);
        }
//        $Pass = $User->getPassword();
        $form = $this->createForm(UserRoleType::class, $UserRole);
        if ($Request->isMethod("POST")) {
            
            $form->handleRequest($Request);
            if ($form->isSubmitted() && $form->isValid()) {
//                $password = $this->get('security.password_encoder')
//                        ->encodePassword($User, $User->getPassword());
//                
//                $User->setPlainPassword($Pass);
//                $User->setPassword($password);
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($UserRole);
                $em->flush();

                return $this->redirectToRoute('tgorz_admin_users_list');
            }
        }
        return $this->render('TgorzTrainingBundle:Admin:addRole.html.twig', array(
                    'test' => 'test',
//                    'username' => $UserRole->getUsername(),
                    'form' => $form->createView()
        ));
    }

}
