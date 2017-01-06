<?php

namespace Tgorz\TrainingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
//use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        
        return $this->render('TgorzTrainingBundle:Default:index.html.twig', array(
            'name' => $name,
        ));
    }
    
    public function registerUserAction($name, $age, $role){
        $responseMsg = sprintf("Rejestracja użytkownika o nazwie %s (wiek: %d),rola w systemie %s", $name, $age, $role);
        return new Response($responseMsg);
    }
    
    public function simple1Action(){
        return new Response('Simple 1');
    }
    
    public function simple2Action(){
        return new Response('Simple 2');
    }
    
    /**
     * @Route(
     *      "/register-tester/{name}/{age}-{role}",
     *      name="tgorz_training_registerTester",
     *      defaults={"role"="units"},
     *      requirements={"age"="\d+", "role"="units|functional"}
     * )
     * 
     * @Method({"GET"})
     */
    public function registerTesterAction($name, $age, $role){
         $responseMsg = sprintf("Rejestracja testera o nazwie %s (wiek: %d),rola w systemie %s", $name, $age, $role);
        return new Response($responseMsg);
    }
    
    /**
     * @Route("/generate-url")
     */
    public function generateUrlAction(){
        
        $response = $this->generateUrl('tgorz_training_registerUser', array(
            'name' => 'Marcin', 
            'age' => 63,
            'country' => 'Poland'
            
            ), TRUE);
        
        
        return new Response($response);
    }
    /**
     * 
     * @Route("/debugging", 
     * name="tgorz_training_debugging")
     */
    public function debuggingAction(){
        return new Response('<html><head><title>Debugging</title></head><body><h1>debugging</h1></body></html>');
    }
    

//    /**
//     * @Route("/admin")
//     */
//    public function adminAction()
//    {
//        return new Response('<html><body>Admin page!</body></html>');
//    }
    
}
