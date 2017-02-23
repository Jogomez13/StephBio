<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Admin controller.
 *
 * @Route("admin")
 * @author jonathan-gomez
 */
class AdminController extends Controller {
    
    /**
     * Cette fonction affiche l'accueil admin
     * @Route("/")
     */
    public function getAccueil() {

    return $this->render('admin/accueiladmin.html.twig');
   
    }
}
