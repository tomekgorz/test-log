<?php

namespace Tgorz\TrainingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/admin/users")
 */

class AdminUserController extends Controller
{
    /**
     * @Route("/", name="tgorz_admin_users_list")
     */
    public function listingAction()
    {
        $Repo = $this->getDoctrine()->getRepository('TgorzTrainingBundle:User');
//        $Users = $Repo->findBy(array('role' => 'ROLE_SUPER_ADMIN'));
        $Users  = $Repo->findByNot('role', 'ROLE_SUPER_ADMIN');
        
        
        return $this->render('TgorzTrainingBundle:AdminUser:listing.html.twig', array(
            'users' => $Users,
        ));
    }

    /**
     * @Route("/delete/{id}", name="tgorz_admin_uses_delete")
     */
    public function deleteAction($id)
    {
        $Repo = $this->getDoctrine()->getRepository("TgorzTrainingBundle:User");
        $User = $Repo->find($id);
        if(!$User){
            $message = 'Nie znaleziono takiego użytkownika';
            throw $this->createNotFoundException($message);
        }
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($User);
        $em->flush();
        $this->get('tgorz_notification')->addSuccess('Poprawnie usunięto użytkownika');
        return $this->redirectToRoute('tgorz_admin_users_list');
       
    }

}
