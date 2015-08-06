<?php

namespace Kezaco\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PublicController extends Controller
{
    /**
     * @Route("/", name="kezaco_search")
     * @Template()
     */
    public function searchAction()
    {

        $request = $this->getRequest();
        $search = $request->get('s');
        $page = $request->get('page', 1);

        if( empty($search) ) return ['search' => ''];

        $pagination = $this->get('kezaco_core.service.search')
            ->searchPaginated($search, $page, 20)
        ;

        return [
            'search' => $search,
            'pagination' => $pagination
        ];
    }

    /**
     * @Route("/resource/{slug}", name="kezaco_show_resource")
     * @Template()
     */
    public function showResourceAction()
    {
        return [ 'resource' => null ];
    }

}
