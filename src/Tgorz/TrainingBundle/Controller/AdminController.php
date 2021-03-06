<?php

namespace Tgorz\TrainingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Tgorz\TrainingBundle\Helper\Journal\Journal;
use Tgorz\TrainingBundle\Helper\DataProvider;
use Tgorz\TrainingBundle\Event\TestEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;
//use Symfony\Component\HttpFoundation\Session\Session;

use Tgorz\TrainingBundle\Form\Type\RegisterType;
use Tgorz\TrainingBundle\Entity\Register;

/**
 * @Route("/admin")
 * 
 */
class AdminController extends Controller {

    /**
     * @Route("/",
     *          name="tgorz_blog_admin_listing")
     * 
     * @Template
     */
    public function listingAction() {
        
       $Repo = $this->getDoctrine()->getRepository('TgorzTrainingBundle:Register');
       $Rows = $Repo->findAll();

       if($this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')){
           $btns = TRUE;
       }else{
           $btns = FALSE;
       }
       $test = 'ss';
       $event = new TestEvent($test);
       $dispatcher = new EventDispatcher();
       $dispatcher->dispatch(TestEvent::TEST, $event);
        return array(
            'rows' => $Rows,
            'btns' => $btns,
            'test' => $test
        );
    }
    
    /**
     * @Route("/details/{id}",
     *          name="tgorz_blog_admin_details")
     * 
     * @Template
     */
    public function detailsAction($id) {
        $Repo = $this->getDoctrine()->getRepository('TgorzTrainingBundle:Register');
        $Register = $Repo->find($id);
        
        
        if($Register == NULL){
            $message = 'Nie znaleziono takiej rejestracji na szkolenie';
            throw $this->createNotFoundException($message);
        }
 
        return array(
            'register' => $Register
        );
    }
    
     /**
     * @Route("/update/{id}",
     *          name="tgorz_blog_admin_update")
     * 
     * @Template
     */
    public function updateAction(Request $Request, $id) {
        $Repo = $this->getDoctrine()->getRepository('TgorzTrainingBundle:Register');
        $Register = $Repo->find($id);
        
        
        if($Register == NULL){
            $message = 'Nie znaleziono takiej rejestracji na szkolenie';
            throw $this->createNotFoundException($message);
        }
        
        $form = $this->createForm(RegisterType::class, $Register);
        
        if($Request->isMethod("POST")){
//            $Session = new Session;
            $form->handleRequest($Request);
            if($form->isValid()){
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($Register);
                $em->flush();
                
//                $Session->getFlashBag()->add('success', 'Zaktualizowano rekord');
                $this->get('tgorz_notification')->addSuccess('Zaktualizowano rekord');
                
                return $this->redirect($this->generateUrl('tgorz_blog_admin_details', array(
                    'id' => $Register->getId()
                )));
                
            }else{
//                $Session->getFlashBag()->add('danger', 'Popraw błędy formularza');
                $this->get('tgorz_notification')->addError('Popraw błędy formularza');
            }
        }
        
        return array(
            'form' => isset($form) ? $form->createView() : NULL,
            'register' => $Register
        );
    }
    
    /**
     * @Route("/delete/{id}",
     *          name="tgorz_blog_admin_delete")
     * 
     * @Template
     */
    public function deleteAction($id) {
        $Repo = $this->getDoctrine()->getRepository('TgorzTrainingBundle:Register');
        $Register = $Repo->find($id);
        
        
        if($Register == NULL){
            $message = 'Nie znaleziono takiej rejestracji na szkolenie';
            throw $this->createNotFoundException($message);
        }
 
        $em = $this->getDoctrine()->getManager();
        $em->remove($Register);
        $em->flush();
        
//        $Session = new Session;
//        $Session->getFlashBag()->add('success', 'Poprawnie usunięto rekord z bazy danych');
        $this->get('tgorz_notification')->addSuccess('Poprawnie usunięto rekord z bazy danych');
        return $this->redirect($this->generateUrl('tgorz_blog_admin_listing'));
    }
    

    

}
