<?php

namespace Kezaco\MediathequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/medias/")
     * @Template()
     */
    public function indexAction()
    {
      return $this->render('KezacoMediathequeBundle:Default:index.html.twig');
    }
}
