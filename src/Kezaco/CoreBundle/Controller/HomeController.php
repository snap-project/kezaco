<?php

namespace Kezaco\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HomeController extends Controller
{
    /**
     * @Route("/home", name="kezaco_home")
     * @Template()
     */
    public function indexAction()
    {
        return [
            'userResources' => [],
            'favorites' => []
        ];
    }

}
