<?php

namespace Mushkin\VitformsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('MushkinVitformsBundle:Default:index.html.twig', array('name' => $name));
    }
}
