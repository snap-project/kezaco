<?php

namespace Kezaco\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="kezaco_index")
     * @Template()
     */
    public function indexAction()
    {

        $request = $this->getRequest();

        $searchTerms = $request->get('s');

        $searchResults = $this->get('kezaco_core.service.search')
            ->search($searchTerms)
        ;

        return [
            'search' => $searchTerms,
            'results' => $searchResults,
            'popular' => $searchResults,
            'recent' => $searchResults
        ];
    }

}
