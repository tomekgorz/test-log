<?php

namespace Tgorz\TrainingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Tgorz\TrainingBundle\Helper\Journal\Journal;
use Tgorz\TrainingBundle\Helper\DataProvider;
use Symfony\Component\HttpFoundation\Session\Session;

use Tgorz\TrainingBundle\Form\Type\RegisterType;
use Tgorz\TrainingBundle\Entity\Register;


class BlogController extends Controller {

    /**
     * @Route("/",
     *          name="tgorz_blog_glowna")
     * 
     * @Template
     */
    public function indexAction() {
        
//        $Test = 'Hellow World';
//        
//        dump($Test);
//        
////        die();
//        
//        $translator = $this->get('translator')->trans($Test);
//        dump($this->get('translator')->trans($Test));
//        
//        die();
        
        return array();
    }

    /**
     * @Route("/dziennik",
     * name="tgorz_blog_dziennik")
     * 
     * 
     * @Template
     */
    public function journalAction() {
        return array(
//            'history' => Journal::getHistoryAsArray()
            'history' => Journal::getHistoryAsObjects()
//            'history' => array()
        );
    }

    /**
     * @Route("/kontakt",
     *          name="tgorz_blog_kontakt")
     * 
     * 
     * @Template
     */
    public function contactAction() {
        return array();
    }

    /**
     * @Route("/ksiega-gosci",
     *          name="tgorz_blog_ksiegaGosci")
     * 
     * 
     * @Template
     */
    public function guestBookAction() {
        return array(
            'comments' => DataProvider::getGuestBook()
        );
    }

    /**
     * @Route("/rejestracja",
     *          name="tgorz_blog_rejestracja")
     * 
     * 
     * @Template
     */
    public function registerAction(Request $Requet) {

        /*
         * Imię i Nazwisko - text
         * Email - text(emial)
         * Płeć - radio collection
         * Data urodzenia - select
         * Kraj - select
         * Kurs - select
         * Inwestycje - checkbox collection
         * Uwagi - textarea
         * Potwierdzenie przelewu - file
         * Akceptacja regulaminu - checkebox
         * Zapisz - button
         */


        $Register = new Register();
        
//        $form = $this->createForm(RegisterType::class, $Register)
                
//                ->getForm();
        $Session = new Session;
        
        if($Session->has('registered')){
        
            $form = $this->createForm(RegisterType::class, $Register);

            $form->handleRequest($Requet);



            if ($Requet->isMethod('POST')) {
                if ($form->isValid()) {

                    $savePath = $this->get('kernel')->getRootDir() . '/../web/uploads/';
                    $Register->save($savePath);
                    
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($Register);
                    $em->flush();
                    
                    $smgBody = $this->render('TgorzTrainingBundle:Email:base.html.twig', array('name' => $Register->getName()));
                    $message = \Swift_Message::newInstance()
                            ->setSubject('Potwierdzenie rejestracji')
                            ->setFrom(array('tgorz89@gmail.com' => 'Tomek Gorz'))
                            ->setTo(array($Register->getEmail() => $Register->getName()))
                            ->setBody($smgBody, 'text/html');

                    $this->get('mailer')->send($message);

//                    $Session->getFlashBag()->add('success', 'Twoje zgłoszenie zostało zapisane');
                    $this->get('tgorz_notification')->addSuccess('Twoje zgłoszenie zostało zapisane');
                    $Session->set('registered', true);

                    return $this->redirect($this->generateUrl("tgorz_blog_rejestracja"));
//            $formData = 'Zapisano dane formularza';
                } else {
                    $this->get('tgorz_notification')->addError('Popraw błędy formularza');
//                    $Session->getFlashBag()->add('danger', 'Popraw błędy formularza');
                }
            }
        }
//        $Session->set('registered', false);
        return array(
            'form' => isset($form) ? $form->createView() : NULL,
            
//            'formData' => isset($formData) ? $formData : NULL,
        );
    }
    

    /**
     * @Template("TgorzTrainingBundle:Blog/Widgets:followingWidget.html.twig")
     */
    public function followingWidgetAction() {

        return array(
            'list' => DataProvider::getFollowings()
        );
    }

    /**
     * @Template("TgorzTrainingBundle:Blog/Widgets:walletWidget.html.twig")
     */
    public function walletAction() {
        return array(
            'list' => DataProvider::getWallet()
        );
    }

}
