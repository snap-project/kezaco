<?php

namespace Kezaco\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/admin/", name="kezaco_admin_index")
     * @Template()
     */
    public function indexAction()
    {
        return array('name' => "roger");
    }
}
