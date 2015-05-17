<?php

namespace Kezaco\MediathequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Kezaco\CoreBundle\Entity\User;

class DefaultController extends Controller
{
    /**
     * @Route("/medias/")
     * @Template()
     */
    public function indexAction()
    {
      $em = $this->getDoctrine()->getManager();

      $user_id = $this->getUser()->getId();

      $medias = $em->getRepository('KezacoCoreBundle:User')
        ->find($user_id)
        ->getMedias();

      return $this->render('KezacoMediathequeBundle:Default:index.html.twig', [
        'medias' => $medias
        ]);
    }
}
