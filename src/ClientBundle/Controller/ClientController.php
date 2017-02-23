<?php

namespace ClientBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Client controller.
 *
 * @Route("client")
 */
class ClientController extends Controller
{       
      /**
     * Lists all prestation entities.
     *
     * @Route("/prestation", name="prestation")
     * @Method("GET")
     */
    public function getPrestations() {
        $em = $this->getDoctrine()->getManager();
        /* J'initialise ma variable Entity Manager */

        $prestations = $em->getRepository('AppBundle:Prestation')->findAll();

        return $this->render('ClientBundle:Default:index.html.twig', array(
                    'prestations' => $prestations,
                        
        ));
    }
    
     /**
     * Lists all ateliers entities.
     *
     * @Route("/ateliers", name="ateliers")
     * @Method("GET")
     */
    public function getAteliers() {
        $em = $this->getDoctrine()->getManager();
 
        $ateliers = $em->getRepository('AppBundle:Ateliers')->findAll();

        return $this->render('ClientBundle:Default:ateliers.html.twig', array(
                    'ateliers' => $ateliers,
                        
        ));
    }
}
