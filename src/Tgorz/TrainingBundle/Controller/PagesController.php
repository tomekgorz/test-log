<?php

namespace Tgorz\TrainingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Tgorz\TrainingBundle\Entity\Product;
class PagesController extends Controller{
    /**
     * 
     * @Route("/about",
     *      name="tgorz_training_about")
     * 
     * @Template
     */
    public function aboutAction(){
//        return new Response('about');
        
//        $json = array(
//            'name' => 'Buty',
//            'size' => '42',
//            'price' => '123.43'
//        );
        
//        return new Response(json_encode($json), Response::HTTP_OK, array('Content-type' => 'application/json'));
        
        
//        $content = $this->renderView('TgorzTrainingBundle:Pages:about.html.twig');
//        return new Response($content);
//    
//        return $this->render('TgorzTrainingBundle:Pages:about.html.twig');
        
        $product = new Product;
        $product->setName("Keyboard");
        $product->setPrice("19.99");
        $product->setDescription("Some text...");
        
        $em = $this->getDoctrine()->getManager();
        
        $em->persist($product);
        
        $em->flush();
        
        return new Response("Saved new product with id ".$product->getId());
        
    }
    
    /**
     * @Route("go-to-page")
     */
    public function goToPageAction(){
 
//        return $this->redirect('http://tomekgorz.com');
        
        $redirectUrl = $this->generateUrl("tgorz_training_about");
        return $this->redirect($redirectUrl);
    }
    
    /**
     * @Route("/print-header/{title}/{color}")
     * @Template
     */
   public function printHeaderAction($title, $color){
       return array(
           'title' => $title,
           'color' => $color
       );
   }
   
   /**
    * 
    * @Route("/contact")
    */
   
   public function contactPageAction(){
       return $this->forward("TgorzTrainingBundle:Pages:printHeader", array(
           'title' => 'Contact',
           'color' => 'blue'
       ));
   }
    
    /**
    * 
    * @Route("/generate-error")
    */
   
   public function generateErrorAction(){
       throw $this->createNotFoundException("Ta strona nie została znaleziona");
       
//        throw  new Exception("Ups. Wystąpil błąd aplikacji");
    }
    
    /**
    * 
    * @Route("/mastering-request/{name}",
     *  name="tgorz_training_mastering_request"
     * )
     * 
     * 
    */
    
    public function masteringRequestAction(Request $Request, $name){
//      return new Response($Request->get('name'));
        return new Response($Request->query->get('nazwa'));
    }
    
    
    /**
    * 
    * @Route("/read-params",
    *  name="tgorz_training_read_params"
    * )
    * 
    * 
    */
    public function readParamsAction(){
        $Param = $this->container->getParameter('appApiKey');
        return new Response($Param);
    }
    
}

