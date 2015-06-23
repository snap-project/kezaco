<?php

namespace Kezaco\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="kezaco_home")
     * @Template()
     */
    public function indexAction()
    {

        $request = $this->getRequest();

        $search = $request->get('search');

        $searchRepo = $this->get('fos_elastica.manager')
            ->getRepository('KezacoCoreBundle:Resource')
        ;

        return [
            'search' => $search,
            'results' => $searchRepo->find($search),
            'popular' => $searchRepo->findPopular(),
            'recent' => $searchRepo->findRecent()
        ];
    }
}
