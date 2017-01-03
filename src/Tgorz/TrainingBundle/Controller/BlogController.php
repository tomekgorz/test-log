<?php

namespace Tgorz\TrainingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Tgorz\TrainingBundle\Helper\Journal\Journal;
use Tgorz\TrainingBundle\Helper\DataProvider;

use Tgorz\TrainingBundle\Form\Type\RegisterType;
use Tgorz\TrainingBundle\Entity\Register;

/**
 * @Route("/blog")
 * 
 */
class BlogController extends Controller {

    /**
     * @Route("/",
     *          name="tgorz_blog_glowna")
     * 
     * @Template
     */
    public function indexAction() {
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
        
        $form = $this->createForm(RegisterType::class, $Register)
                
                ->getForm();


        $form->handleRequest($Requet);

        if ($form->isValid()) {

            $savePath = $this->get('kernel')->getRootDir() . '/../web/uploads/';
            $Register->save($savePath);


            $formData = 'Zapisano dane formularza';
        }

        return array(
            'form' => $form->createView(),
            
            'formData' => isset($formData) ? $formData : NULL,
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
